<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UpdateWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather data from BMKG API every 3 hours';

    private const BMKG_API_URL = 'https://api.bmkg.go.id/publik/prakiraan-cuaca';
    private const SAMARINDA_REGION_CODE = '64.72.03.1002';
    private const CACHE_KEY = 'bmkg_weather_samarinda';
    private const CACHE_DURATION = 10800; // 3 hours in seconds

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Updating weather data from BMKG API...');

        try {
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
                $weatherData = $response->json();

                // Store in cache for 3 hours
                Cache::put(self::CACHE_KEY, $weatherData, self::CACHE_DURATION);
                Cache::put(self::CACHE_KEY . '_timestamp', now(), self::CACHE_DURATION);

                $this->info('Weather data updated successfully!');
                $this->info('Data cached until: ' . now()->addSeconds(self::CACHE_DURATION)->format('Y-m-d H:i:s'));

                Log::info('Weather data updated successfully via scheduled command');

                return Command::SUCCESS;
            } else {
                $this->error('Failed to fetch weather data. Status: ' . $response->status());
                Log::error('Weather update failed. Status: ' . $response->status());

                return Command::FAILURE;
            }

        } catch (\Exception $e) {
            $this->error('Error updating weather data: ' . $e->getMessage());
            Log::error('Weather update error: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
