<?php

namespace Tests\Feature\Geo;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ReverseTest extends TestCase
{
    /**
     *
     * @var array
     */
    protected $apiResponse = [
        [
            'name' => 'London',
            'local_names' => [
                'tt' => 'Лондон',
                'pt' => 'Londres',
                'fy' => 'Londen',
                'tr' => 'Londra',
                'kv' => 'Лондон',
                'sr' => 'Лондон',
                'is' => 'Lundúnir',
                'bo' => 'ལོན་ཊོན།',
                'ru' => 'Лондон',
                'no' => 'London',
                'vi' => 'Luân Đôn',
                'mk' => 'Лондон',
                'lo' => 'ລອນດອນ',
                'kn' => 'ಲಂಡನ್',
                'sk' => 'Londýn',
                'sa' => 'लन्डन्',
                'ab' => 'Лондан',
                'eo' => 'Londono',
                'gv' => 'Lunnin',
                'gn' => 'Londye',
                'fr' => 'Londres',
                'sl' => 'London',
                'li' => 'Londe',
                'ta' => 'இலண்டன்',
                'ko' => '런던',
                'hy' => 'Լոնդոն',
                'mr' => 'लंडन',
                'lv' => 'Londona',
                'si' => 'ලන්ඩන්',
                'mi' => 'Rānana',
                'kk' => 'Лондон',
                'bn' => 'লন্ডন',
                'wo' => 'Londar',
                'br' => 'Londrez',
                'ascii' => 'London',
                'ro' => 'Londra',
                'gd' => 'Lunnainn',
                'yo' => 'Lọndọnu',
                'th' => 'ลอนดอน',
                'ga' => 'Londain',
                'os' => 'Лондон',
                'cy' => 'Llundain',
                'cv' => 'Лондон',
                'ps' => 'لندن',
                'my' => 'လန်ဒန်မြို့',
                'ln' => 'Londoni',
                'en' => 'London',
                'pl' => 'Londyn',
                'he' => 'לונדון',
                'mn' => 'Лондон',
                'de' => 'London',
                'oc' => 'Londres',
                'rm' => 'Londra',
                'ku' => 'London',
                'bg' => 'Лондон',
                'an' => 'Londres',
                'et' => 'London',
                'sc' => 'Londra',
                'lt' => 'Londonas',
                'co' => 'Londra',
                'cu' => 'Лондонъ',
                'te' => 'లండన్',
                'gl' => 'Londres',
                'ca' => 'Londres',
                'el' => 'Λονδίνο',
                'ka' => 'ლონდონი',
                'ky' => 'Лондон',
                'ba' => 'Лондон',
                'sv' => 'London',
                'eu' => 'Londres',
                'es' => 'Londres',
                'uk' => 'Лондон',
                'mt' => 'Londra',
                'it' => 'Londra',
                'ne' => 'लण्डन',
                'yi' => 'לאנדאן',
                'be' => 'Лондан',
                'feature_name' => 'London',
                'sq' => 'Londra',
                'tl' => 'Londres',
                'nl' => 'Londen',
                'ar' => 'لندن',
                'zh' => '伦敦',
                'hi' => 'लंदन',
                'or' => 'ଲଣ୍ଡନ',
                'ht' => 'Lonn',
                'cs' => 'Londýn',
                'fa' => 'لندن',
                'tg' => 'Лондон',
                'hu' => 'London',
                'zu' => 'ILondon',
                'ur' => 'لندن',
                'af' => 'Londen',
                'ja' => 'ロンドン',
                'fi' => 'Lontoo',
                'kw' => 'Loundres',
                'gu' => 'લંડન',
                'am' => 'ለንደን',
                'ml' => 'ലണ്ടൻ',
            ],
            'lat' => 51.5073219,
            'lon' => -0.1276474,
            'country' => 'GB',
            'state' => 'England',
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
            'lat' => '51.5098',
            'lon' => '-0.1180',
        ];

        $response = $this->json('GET', sprintf('%s/api/geo/reverse', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/geo/1.0/reverse?lat=%s&lon=%s&appid=%s',
                config('services.open_weather.url'),
                '51.5098',
                '-0.1180',
                config('services.open_weather.api_key')
            );
        });
    }

    /**
     * Test lat, lon, and limit.
     *
     * @return void
     */
    public function test_lat_lon_limit()
    {
        $this->fake();

        $query = [
            'lat' => '51.5098',
            'lon' => '-0.1180',
            'limit' => 5,
        ];

        $response = $this->json('GET', sprintf('%s/api/geo/reverse', config('services.open_weather.url')), $query);

        $response->assertStatus(200)
            ->assertJson($this->apiResponse);

        Http::assertSent(function (Request $request) {
            return $request->url() === sprintf(
                '%s/geo/1.0/reverse?lat=%s&lon=%s&limit=%s&appid=%s',
                config('services.open_weather.url'),
                '51.5098',
                '-0.1180',
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
        $response = $this->json('GET', '/api/geo/reverse');

        $response->assertStatus(422)
            ->assertJsonValidationErrors('lat')
            ->assertJsonValidationErrors('lon');
    }

    /**
     *
     * @return void
     */
    protected function fake()
    {
        Http::preventStrayRequests();

        Http::fake([
            sprintf('%s/geo/1.0/reverse?*', config('services.open_weather.url')) => Http::response($this->apiResponse),
        ]);
    }
}
