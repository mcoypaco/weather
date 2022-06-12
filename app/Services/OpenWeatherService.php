<?php

namespace App\Services;

use App\Services\Interfaces\OpenWeatherServiceInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class OpenWeatherService implements OpenWeatherServiceInterface
{
    /**
     * HTTP GET request to /geo/1.0/direct endpoint.
     * https://openweathermap.org/api/geocoding-api#direct_name
     *
     * @var array $query
     * @return mixed
     */
    public function geoDirect(array $query)
    {
        $url = sprintf('%s/geo/1.0/direct', config('services.open_weather.url'));

        Arr::set($query, 'appid', config('services.open_weather.api_key'));

        return Http::get($url, $query)
            ->throw()
            ->json();
    }

    /**
     * HTTP GET request to /geo/1.0/zip endpoint.
     * https://openweathermap.org/api/geocoding-api#direct_zip
     *
     * @var array $query
     * @return mixed
     */
    public function geoZip(array $query)
    {
        $url = sprintf('%s/geo/1.0/zip', config('services.open_weather.url'));

        Arr::set($query, 'appid', config('services.open_weather.api_key'));

        return Http::get($url, $query)
            ->throw()
            ->json();
    }

    /**
     * HTTP GET request to /geo/1.0/reverse endpoint.
     * https://openweathermap.org/api/geocoding-api#reverse
     *
     * @param array $query
     * @return mixed
     */
    public function geoReverse(array $query)
    {
        $url = sprintf('%s/geo/1.0/reverse', config('services.open_weather.url'));

        Arr::set($query, 'appid', config('services.open_weather.api_key'));

        return Http::get($url, $query)
            ->throw()
            ->json();
    }

    /**
     * HTTP GET request to /data/2.5/weather endpoint.
     * https://openweathermap.org/current#one
     *
     * @param array $query
     * @return mixed
     */
    public function weather(array $query)
    {
        $url = sprintf('%s/data/2.5/weather', config('services.open_weather.url'));

        Arr::set($query, 'appid', config('services.open_weather.api_key'));

        return Http::get($url, $query)
            ->throw()
            ->json();
    }

    /**
     * HTTP GET request to /data/2.5/forecast endpoint.
     * https://openweathermap.org/forecast5#5days
     *
     * @param array $query
     * @return mixed
     */
    public function forecast(array $query)
    {
        $url = sprintf('%s/data/2.5/forecast', config('services.open_weather.url'));

        Arr::set($query, 'appid', config('services.open_weather.api_key'));

        return Http::get($url, $query)
            ->throw()
            ->json();
    }

    /**
     * HTTP GET request to /data/2.5/onecall endpoint.
     * https://openweathermap.org/api/one-call-api#current
     *
     * @param array $query
     * @return array
     */
    public function oneCall(array $query)
    {
        $url = sprintf('%s/data/2.5/onecall', config('services.open_weather.url'));

        Arr::set($query, 'appid', config('services.open_weather.api_key'));

        return Http::get($url, $query)
            ->throw()
            ->json();
    }
}
