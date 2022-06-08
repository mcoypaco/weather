<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherForecast\ForecastRequest;
use App\Http\Requests\WeatherForecast\WeatherRequest;
use App\Services\Interfaces\OpenWeatherServiceInterface;

class WeatherForecastController extends Controller
{
    /**
     * The OpenWeatherService instance.
     *
     * @var \App\Services\OpenWeatherService
     */
    protected $openWeatherService;

    /**
     * Create the class instance and inject its dependencies.
     *
     * @param \App\Services\OpenWeatherService $openWeatherService
     * @return void
     */
    public function __construct(OpenWeatherServiceInterface $openWeatherService)
    {
        $this->openWeatherService = $openWeatherService;
    }

    /**
     *
     * @param \App\Http\Requests\WeatherForecast\WeatherRequest $request
     * @return mixed
     */
    public function weather(WeatherRequest $request)
    {
        return $this->openWeatherService->weather($request->validated());
    }

    /**
     *
     * @param \App\Http\Requests\ForecastRequest $request
     * @return mixed
     */
    public function forecast(ForecastRequest $request)
    {
        return $this->openWeatherService->forecast($request->validated());
    }
}
