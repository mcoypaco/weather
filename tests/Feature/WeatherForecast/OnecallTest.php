<?php

namespace Tests\Feature\WeatherForecast;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OnecallTest extends TestCase
{
    /**
     *
     * @var array
     */
    protected $apiResponse = [
        'lat' => 35,
        'lon' => 139,
        'timezone' => 'Asia/Tokyo',
        'timezone_offset' => 32400,
        'current' => [
            'dt' => 1654841341,
            'sunrise' => 1654802984,
            'sunset' => 1654855030,
            'temp' => 21.29,
            'feels_like' => 21.59,
            'pressure' => 1014,
            'humidity' => 81,
            'dew_point' => 17.9,
            'uvi' => 4.35,
            'clouds' => 64,
            'visibility' => 10000,
            'wind_speed' => 0.36,
            'wind_deg' => 162,
            'wind_gust' => 1.21,
            'weather' => [
                [
                    'id' => 803,
                    'main' => 'Clouds',
                    'description' => 'broken clouds',
                    'icon' => '04d',
                ],
            ],
        ],
        'minutely' => [
            [
                'dt' => 1654841400,
                'precipitation' => 0,
            ],
        ],
        'hourly' => [
            [
                'dt' => 1654840800,
                'temp' => 21.29,
                'feels_like' => 21.59,
                'pressure' => 1014,
                'humidity' => 81,
                'dew_point' => 17.9,
                'uvi' => 4.35,
                'clouds' => 64,
                'visibility' => 10000,
                'wind_speed' => 0.36,
                'wind_deg' => 162,
                'wind_gust' => 1.21,
                'weather' => [
                    [
                        'id' => 500,
                        'main' => 'Rain',
                        'description' => 'light rain',
                        'icon' => '10d',
                    ],
                ],
                'pop' => 0.52,
                'rain' => [
                    '1h' => 0.69,
                ],
            ],
        ],
        'daily' => [
            [
                'dt' => 1654826400,
                'sunrise' => 1654802984,
                'sunset' => 1654855030,
                'moonrise' => 1654837680,
                'moonset' => 1654791600,
                'moon_phase' => 0.33,
                'temp' => [
                    'day' => 21.07,
                    'min' => 15.93,
                    'max' => 21.48,
                    'night' => 17.1,
                    'eve' => 21.04,
                    'morn' => 15.93,
                ],
                'feels_like' => [
                    'day' => 21.3,
                    'night' => 17.35,
                    'eve' => 21.34,
                    'morn' => 16.06,
                ],
                'pressure' => 1016,
                'humidity' => 79,
                'dew_point' => 17.29,
                'wind_speed' => 1.67,
                'wind_deg' => 66,
                'wind_gust' => 1.83,
                'weather' => [
                    [
                        'id' => 501,
                        'main' => 'Rain',
                        'description' => 'moderate rain',
                        'icon' => '10d',
                    ],
                ],
                'clouds' => 82,
                'pop' => 0.72,
                'rain' => 6.2,
                'uvi' => 8.48,
            ],
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

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/onecall', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/onecall?lat=%s&lon=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test lat, lon, and exclude.
     *
     * @return void
     */
    public function test_lat_lon_exclude()
    {
        $this->fake();

        $query = [
            'lat' => 35,
            'lon' => 139,
            'exclude' => 'alerts',
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/onecall', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/onecall?lat=%s&lon=%s&exclude=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                'alerts',
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

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/onecall', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/onecall?lat=%s&lon=%s&units=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                'metric',
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

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/onecall', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/onecall?lat=%s&lon=%s&lang=%s&appid=%s',
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
        $response = $this->json('GET', '/api/weather-forecast/onecall');

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
            sprintf('%s/data/2.5/onecall?*', config('services.open_weather.url')) => Http::response($this->apiResponse),
        ]);
    }
}
