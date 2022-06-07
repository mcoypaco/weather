<?php

namespace App\Services\Interfaces;

interface OpenWeatherServiceInterface
{
    /**
     * HTTP GET request to /geo/1.0/direct endpoint.
     * https://openweathermap.org/api/geocoding-api#direct_name
     *
     * @var array $query
     * @return array
     */
    public function geoDirect(array $query);

    /**
     * HTTP GET request to /geo/1.0/zip endpoint.
     * https://openweathermap.org/api/geocoding-api#direct_zip
     *
     * @var array $query
     * @return array
     */
    public function geoZip(array $query);

    /**
     * HTTP GET request to /geo/1.0/reverse endpoint.
     * https://openweathermap.org/api/geocoding-api#reverse
     *
     * @param array $query
     * @return array
     */
    public function geoReverse(array $query);

    /**
     * HTTP GET request to /data/2.5/weather endpoint.
     * https://openweathermap.org/current#one
     *
     * @param array $query
     * @return array
     */
    public function weather(array $query);

    /**
     * HTTP GET request to /data/2.5/forecast endpoint.
     * https://openweathermap.org/forecast5#5days
     *
     * @param array $query
     * @return array
     */
    public function forecast(array $query);
}
