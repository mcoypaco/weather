<?php

namespace Tests\Feature\Geo;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DirectTest extends TestCase
{
    /**
     *
     * @var array
     */
    protected $apiResponse = [
        [
            'name' => 'London',
            'local_names' => [
                'af' => 'Londen',
                'ar' => 'لندن',
                'ascii' => 'London',
                'az' => 'London',
                'bg' => 'Лондон',
                'ca' => 'Londres',
                'da' => 'London',
                'de' => 'London',
                'el' => 'Λονδίνο',
                'en' => 'London',
                'eu' => 'Londres',
                'fa' => 'لندن',
                'feature_name' => 'London',
                'fi' => 'Lontoo',
                'fr' => 'Londres',
                'gl' => 'Londres',
                'he' => 'לונדון',
                'hi' => 'लंदन',
                'hr' => 'London',
                'hu' => 'London',
                'id' => 'London',
                'it' => 'Londra',
                'ja' => 'ロンドン',
                'la' => 'Londinium',
                'lt' => 'Londonas',
                'mk' => 'Лондон',
                'nl' => 'Londen',
                'no' => 'London',
                'pl' => 'Londyn',
                'pt' => 'Londres',
                'ro' => 'Londra',
                'ru' => 'Лондон',
                'sk' => 'Londýn',
                'sl' => 'London',
                'sr' => 'Лондон',
                'th' => 'ลอนดอน',
                'tr' => 'Londra',
                'vi' => 'Luân Đôn',
                'zu' => 'ILondo',
            ],
            'lat' => 51.5085,
            'lon' => -0.1257,
            'country' => 'GB',
        ],
    ];

    /**
     * Test city and country_code.
     *
     * @return void
     */
    public function test_city_country_code()
    {
        $this->fake();

        $query = [
            'city' => 'London',
            'country_code' => 'GB',
        ];

        $response = $this->json('GET', '/api/geo/direct', $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() == sprintf(
                '%s/geo/1.0/direct?q=%s&appid=%s',
                config('services.open_weather.url'),
                rawurlencode('London,GB'),
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test city, country_code and limit.
     *
     * @return void
     */
    public function test_city_country_code_limit()
    {
        $this->fake();

        $query = [
            'city' => 'London',
            'country_code' => 'GB',
            'limit' => 5,
        ];

        $response = $this->json('GET', '/api/geo/direct', $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() == sprintf(
                '%s/geo/1.0/direct?q=%s&limit=%s&appid=%s',
                config('services.open_weather.url'),
                rawurlencode('London,GB'),
                5,
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test city, state, country and limit.
     *
     * @return void
     */
    public function test_city_state_code_country_code_limit()
    {
        $this->fake();

        $query = [
            'city' => 'Palo Alto',
            'state_code' => 'CA',
            'country_code' => 'US',
            'limit' => 5,
        ];

        $response = $this->json('GET', '/api/geo/direct', $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() == sprintf(
                '%s/geo/1.0/direct?q=%s&limit=%s&appid=%s',
                config('services.open_weather.url'),
                rawurlencode('Palo Alto,CA,US'),
                5,
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
        $response = $this->json('GET', '/api/geo/direct');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('city')
            ->assertJsonValidationErrors('country_code');
    }

    /**
     *
     * @return void
     */
    protected function fake()
    {
        Http::preventStrayRequests();

        Http::fake([
            sprintf('%s/geo/1.0/direct?*', config('services.open_weather.url')) => Http::response($this->apiResponse),
        ]);
    }
}
