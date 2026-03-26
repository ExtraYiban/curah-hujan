<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    private const BMKG_API_URL = 'https://api.bmkg.go.id/publik/prakiraan-cuaca';

    private const SAMARINDA_REGION_CODE = '64.72.03.1002';

    private const CACHE_KEY = 'bmkg_weather_samarinda';

    private const FALLBACK_CACHE_KEY = 'bmkg_weather_samarinda_fallback';

    private const CACHE_DURATION = 10800; // 3 hours in seconds

    /**
     * Get weather data for Samarinda
     * Data is cached for 3 hours to reduce API calls
     */
    public function index(): JsonResponse
    {
        try {
            $weatherData = Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, function () {
                return $this->fetchWeatherFromBMKG();
            });

            if (! $weatherData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch weather data',
                ], 500);
            }

            return response()->json([
                'success' => true,
                'data' => $weatherData,
                'cached_at' => Cache::get(self::CACHE_KEY.'_timestamp', now()),
                'cache_expires_in' => $this->getCacheExpirationTime(),
            ]);

        } catch (\Exception $e) {
            Log::error('Weather API Error: '.$e->getMessage());

            $staleWeatherData = Cache::get(self::FALLBACK_CACHE_KEY);

            if ($staleWeatherData) {
                return response()->json([
                    'success' => true,
                    'data' => $staleWeatherData,
                    'cached_at' => Cache::get(self::CACHE_KEY.'_timestamp', now()),
                    'cache_expires_in' => 0,
                    'stale' => true,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error fetching weather data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch fresh weather data from BMKG API
     *
     *
     * @throws \Exception
     */
    private function fetchWeatherFromBMKG(): array
    {
        $http = Http::connectTimeout(3)->timeout(5)->retry(2, 250);

        // Disable SSL verification in local development
        if (config('app.env') === 'local') {
            $http = $http->withOptions(['verify' => false]);
        }

        /** @var \Illuminate\Http\Client\Response $response */
        $response = $http->get(self::BMKG_API_URL, [
            'adm4' => self::SAMARINDA_REGION_CODE,
        ]);

        if ($response->successful()) {
            $data = $this->normalizeWeatherData($response->json());

            // Store timestamp when data was fetched
            Cache::put(self::CACHE_KEY.'_timestamp', now(), self::CACHE_DURATION);
            Cache::put(self::FALLBACK_CACHE_KEY, $data, self::CACHE_DURATION * 2);

            return $data;
        }

        throw new \Exception('BMKG API request failed with status: '.$response->status());
    }

    /**
     * Manually refresh weather data (bypass cache)
     */
    public function refresh(): JsonResponse
    {
        try {
            Cache::forget(self::CACHE_KEY);
            Cache::forget(self::CACHE_KEY.'_timestamp');

            $weatherData = $this->fetchWeatherFromBMKG();

            Cache::put(self::CACHE_KEY, $weatherData, self::CACHE_DURATION);

            return response()->json([
                'success' => true,
                'message' => 'Weather data refreshed successfully',
                'data' => $weatherData,
                'cached_at' => now(),
            ]);

        } catch (\Exception $e) {
            Log::error('Weather Refresh Error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to refresh weather data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Keep only fields used by the frontend to reduce response size and parsing time.
     *
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    private function normalizeWeatherData(array $payload): array
    {
        $locations = collect($payload['data'] ?? [])->map(function (array $location): array {
            $normalizedLocation = [
                'lokasi' => [
                    'adm1' => $location['lokasi']['adm1'] ?? null,
                    'adm2' => $location['lokasi']['adm2'] ?? null,
                    'adm3' => $location['lokasi']['adm3'] ?? null,
                    'adm4' => $location['lokasi']['adm4'] ?? null,
                    'provinsi' => $location['lokasi']['provinsi'] ?? null,
                    'kotkab' => $location['lokasi']['kotkab'] ?? null,
                    'kecamatan' => $location['lokasi']['kecamatan'] ?? null,
                    'desa' => $location['lokasi']['desa'] ?? null,
                    'lat' => $location['lokasi']['lat'] ?? null,
                    'lon' => $location['lokasi']['lon'] ?? null,
                ],
                'cuaca' => [],
            ];

            $normalizedLocation['cuaca'] = collect($location['cuaca'] ?? [])->map(function (array $dayForecasts): array {
                return collect($dayForecasts)->map(function (array $forecast): array {
                    return [
                        'datetime' => $forecast['datetime'] ?? null,
                        'local_datetime' => $forecast['local_datetime'] ?? null,
                        't' => $forecast['t'] ?? null,
                        'weather' => $forecast['weather'] ?? null,
                        'weather_desc' => $forecast['weather_desc'] ?? null,
                        'hu' => $forecast['hu'] ?? null,
                    ];
                })->values()->all();
            })->values()->all();

            return $normalizedLocation;
        })->values()->all();

        return [
            'data' => $locations,
        ];
    }

    /**
     * Get cache expiration time in minutes
     */
    private function getCacheExpirationTime(): int
    {
        $cachedAt = Cache::get(self::CACHE_KEY.'_timestamp');

        if (! $cachedAt) {
            return 0;
        }

        $expiresAt = $cachedAt->addSeconds(self::CACHE_DURATION);
        $minutesRemaining = now()->diffInMinutes($expiresAt, false);

        return max(0, $minutesRemaining);
    }
}
