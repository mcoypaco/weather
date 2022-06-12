<?php

namespace Tests\Feature\WeatherForecast;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     *
     * @var array
     */
    protected $apiResponse = [
        'coord' => [
            'lon' => 139,
            'lat' => 35,
        ],
        'weather' => [
            [
                'id' => 804,
                'main' => 'Clouds',
                'description' => 'overcast clouds',
                'icon' => '04n',
            ],
        ],
        'base' => 'stations',
        'main' => [
            'temp' => 287.21,
            'feels_like' => 287.18,
            'temp_min' => 287.21,
            'temp_max' => 287.21,
            'pressure' => 1005,
            'humidity' => 96,
        ],
        'visibility' => 1012,
        'wind' => [
            'speed' => 0.45,
            'deg' => 86,
            'gust' => 1.34,
        ],
        'clouds' => [
            'all' => 100,
        ],
        'dt' => 1654602849,
        'sys' => [
            'type' => 2,
            'id' => 2019346,
            'country' => 'JP',
            'sunrise' => 1654543808,
            'sunset' => 1654595741,
        ],
        'timezone' => 32400,
        'id' => 1851632,
        'name' => 'Shuzenji',
        'cod' => 200,
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

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/weather', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/weather?lat=%s&lon=%s&appid=%s',
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

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/weather', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/weather?lat=%s&lon=%s&mode=%s&appid=%s',
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
            'units' => 'standard',
        ];

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/weather', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/weather?lat=%s&lon=%s&units=%s&appid=%s',
                config('services.open_weather.url'),
                35,
                139,
                'standard',
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

        $response = $this->json('GET', sprintf('%s/api/weather-forecast/weather', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/data/2.5/weather?lat=%s&lon=%s&lang=%s&appid=%s',
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
        $response = $this->json('GET', '/api/weather-forecast/weather');

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
            sprintf('%s/data/2.5/weather?*', config('services.open_weather.url')) => Http::response($this->apiResponse),
        ]);
    }
}
