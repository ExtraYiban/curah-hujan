<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    private const BMKG_API_URL = 'https://api.bmkg.go.id/publik/prakiraan-cuaca';
    private const SAMARINDA_REGION_CODE = '64.72.03.1002';
    private const CACHE_KEY = 'bmkg_weather_samarinda';
    private const CACHE_DURATION = 10800; // 3 hours in seconds

    /**
     * Get weather data for Samarinda
     * Data is cached for 3 hours to reduce API calls
     */
    public function index()
    {
        try {
            $weatherData = Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, function () {
                return $this->fetchWeatherFromBMKG();
            });

            if (!$weatherData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch weather data'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'data' => $weatherData,
                'cached_at' => Cache::get(self::CACHE_KEY . '_timestamp', now()),
                'cache_expires_in' => $this->getCacheExpirationTime()
            ]);

        } catch (\Exception $e) {
            Log::error('Weather API Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error fetching weather data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch fresh weather data from BMKG API
     *
     * @return array
     * @throws \Exception
     */
    private function fetchWeatherFromBMKG()
    {
        $http = Http::timeout(10);

        // Disable SSL verification in local development
        if (config('app.env') === 'local') {
            $http = $http->withOptions(['verify' => false]);
        }

        /** @var \Illuminate\Http\Client\Response $response */
        $response = $http->get(self::BMKG_API_URL, [
            'adm4' => self::SAMARINDA_REGION_CODE
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Store timestamp when data was fetched
            Cache::put(self::CACHE_KEY . '_timestamp', now(), self::CACHE_DURATION);

            return $data;
        }

        throw new \Exception('BMKG API request failed with status: ' . $response->status());
    }

    /**
     * Manually refresh weather data (bypass cache)
     */
    public function refresh()
    {
        try {
            Cache::forget(self::CACHE_KEY);
            Cache::forget(self::CACHE_KEY . '_timestamp');

            $weatherData = $this->fetchWeatherFromBMKG();

            Cache::put(self::CACHE_KEY, $weatherData, self::CACHE_DURATION);

            return response()->json([
                'success' => true,
                'message' => 'Weather data refreshed successfully',
                'data' => $weatherData,
                'cached_at' => now()
            ]);

        } catch (\Exception $e) {
            Log::error('Weather Refresh Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to refresh weather data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cache expiration time in minutes
     */
    private function getCacheExpirationTime()
    {
        $cachedAt = Cache::get(self::CACHE_KEY . '_timestamp');

        if (!$cachedAt) {
            return 0;
        }

        $expiresAt = $cachedAt->addSeconds(self::CACHE_DURATION);
        $minutesRemaining = now()->diffInMinutes($expiresAt, false);

        return max(0, $minutesRemaining);
    }
}
