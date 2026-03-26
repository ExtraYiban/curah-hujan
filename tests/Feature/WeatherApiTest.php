<?php

use Illuminate\Support\Facades\Http;

test('weather endpoint returns normalized payload and uses cache', function () {
    Http::fake([
        'https://api.bmkg.go.id/*' => Http::response([
            'data' => [
                [
                    'lokasi' => [
                        'adm1' => 'Kalimantan Timur',
                        'adm2' => 'Kota Samarinda',
                        'adm3' => 'Samarinda Ulu',
                        'adm4' => '64.72.03.1002',
                        'provinsi' => 'Kalimantan Timur',
                        'kotkab' => 'Samarinda',
                        'kecamatan' => 'Samarinda Ulu',
                        'desa' => 'Air Putih',
                        'lat' => '-0.49',
                        'lon' => '117.14',
                        'timezone' => 'Asia/Makassar',
                    ],
                    'cuaca' => [
                        [
                            [
                                'datetime' => '2026-03-26T00:00:00Z',
                                'local_datetime' => '2026-03-26 08:00:00',
                                't' => 28,
                                'weather' => 1,
                                'weather_desc' => 'Cerah Berawan',
                                'hu' => 80,
                                'ws' => 12,
                                'wd' => 'NE',
                            ],
                        ],
                    ],
                ],
            ],
        ], 200),
    ]);

    $firstResponse = $this->getJson('/api/weather');

    $firstResponse
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.data.0.lokasi.adm4', '64.72.03.1002')
        ->assertJsonPath('data.data.0.cuaca.0.0.weather_desc', 'Cerah Berawan')
        ->assertJsonMissingPath('data.data.0.cuaca.0.0.ws');

    $secondResponse = $this->getJson('/api/weather');

    $secondResponse
        ->assertOk()
        ->assertJsonPath('success', true);

    Http::assertSentCount(1);
});
