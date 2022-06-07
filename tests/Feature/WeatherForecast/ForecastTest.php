<?php

namespace Tests\Feature\WeatherForecast;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ForecastTest extends TestCase
{
    /**
     *
     * @var array
     */
    protected $apiResponse = [
        'cod' => '200',
        'message' => 0,
        'cnt' => 1,
        'list' => [
            [
                'dt' => 1654614000,
                'main' => [
                    'temp' => 14.1,
                    'feels_like' => 14.1,
                    'temp_min' => 14.1,
                    'temp_max' => 14.19,
                    'pressure' => 1007,
                    'sea_level' => 1007,
                    'grnd_level' => 980,
                    'humidity' => 97,
                    'temp_kf' => -0.09,
                ],
                'weather' => [
                    [
                        'id' => 500,
                        'main' => 'Rain',
                        'description' => 'light rain',
                        'icon' => '10n',
                    ],
                ],
                'clouds' => [
                    'all' => 100,
                ],
                'wind' => [
                    'speed' => 4.28,
                    'deg' => 53,
                    'gust' => 6.7,
                ],
                'visibility' => 1484,
                'pop' => 0.96,
                'rain' => [
                    '3h' => 1.19,
                ],
                'sys' => [
                    'pod' => 'n',
                ],
                'dt_txt' => '2022-06-07 15 =>00 =>00',
            ],
        ],
        'city' => [
            'id' => 1851632,
            'name' => 'Shuzenji',
            'coord' => [
                'lat' => 35,
                'lon' => 139,
            ],
            'country' => 'JP',
            'population' => 0,
            'timezone' => 32400,
            'sunrise' => 1654543808,
            'sunset' => 1654595741,
        ],
    ];

    /**
     * Test lat and lon.
     *
     * @return void
     */
    public function test_lat_lon()
    {
        $this->fake();

        $query = [
            'lat' => 35,
            'lon' => 139,
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/forecast', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/forecast?lat=%s&lon=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test lat, lon, and mode.
     *
     * @return void
     */
    public function test_lat_lon_mode()
    {
        $this->fake();

        $query = [
            'lat' => 35,
            'lon' => 139,
            'mode' => 'xml',
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/forecast', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/forecast?lat=%s&lon=%s&mode=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                'xml',
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test lat, lon, and units.
     *
     * @return void
     */
    public function test_lat_lon_units()
    {
        $this->fake();

        $query = [
            'lat' => 35,
            'lon' => 139,
            'units' => 'metric',
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/forecast', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/forecast?lat=%s&lon=%s&units=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                'metric',
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test lat, lon, and cnt.
     *
     * @return void
     */
    public function test_lat_lon_cnt()
    {
        $this->fake();

        $query = [
            'lat' => 35,
            'lon' => 139,
            'cnt' => 1,
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/forecast', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/forecast?lat=%s&lon=%s&cnt=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                1,
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test lat, lon, and lang.
     *
     * @return void
     */
    public function test_lat_lon_lang()
    {
        $this->fake();

        $query = [
            'lat' => 35,
            'lon' => 139,
            'lang' => 'en',
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/forecast', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/forecast?lat=%s&lon=%s&lang=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                'en',
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test validation works.
     *
     * @return void
     */
    public function test_validation()
    {
        $response = $this->json('GET', '/api/weather-forecast/forecast');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('lon')
            ->assertJsonValidationErrors('lat');
    }

    /**
     *
     * @return void
     */
    protected function fake()
    {
        Http::preventStrayRequests();

        Http::fake([
            sprintf('%s/data/2.5/forecast?*', config('services.open_weather.url')) => Http::response($this->apiResponse),
        ]);
    }
}
