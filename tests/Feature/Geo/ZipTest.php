<?php

namespace Tests\Feature\Geo;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ZipTest extends TestCase
{
    /**
     *
     * @var array
     */
    protected $apiResponse = [
        'zip' => 'E14',
        'name' => 'London',
        'lat' => 51.4969,
        'lon' => -0.0087,
        'country' => 'GB',
    ];

    /**
     * Test zip code and country code.
     *
     * @return void
     */
    public function test_zip_code_country_code()
    {
        $this->fake();

        $query = [
            'zip_code' => 'E14',
            'country_code' => 'GB',
        ];

        $response = $this->json('GET', sprintf('%s/api/geo/zip', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() == sprintf(
                '%s/geo/1.0/zip?zip=%s&appid=%s',
                config('services.open_weather.url'),
                rawurlencode('E14,GB'),
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
        $response = $this->json('GET', '/api/geo/zip');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('zip_code')
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
            sprintf('%s/geo/1.0/zip?*', config('services.open_weather.url')) => Http::response($this->apiResponse),
        ]);
    }
}
