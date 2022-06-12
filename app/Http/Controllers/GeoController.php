<?php

namespace App\Http\Controllers;

use App\Http\Requests\Geo\DirectRequest;
use App\Http\Requests\Geo\ReverseRequest;
use App\Http\Requests\Geo\ZipRequest;
use App\Services\Interfaces\OpenWeatherServiceInterface;
use Illuminate\Support\Arr;

class GeoController extends Controller
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
     * @param \App\Http\Requests\Geo\DirectRequest $request
     * @return mixed
     */
    public function direct(DirectRequest $request)
    {
        $validatedRequest = $request->validated();

        $q = [];

        array_push($q, Arr::get($validatedRequest, 'city'));

        if (Arr::has($validatedRequest, 'state_code')) {
            array_push($q, Arr::get($validatedRequest, 'state_code'));
        }

        if (Arr::has($validatedRequest, 'country_code')) {
            array_push($q, Arr::get($validatedRequest, 'country_code'));
        }

        $query = [
            'q' => implode(',', $q),
        ];

        if (Arr::has($validatedRequest, 'limit')) {
            Arr::set($query, 'limit', Arr::get($validatedRequest, 'limit'));
        }

        return $this->openWeatherService->geoDirect($query);
    }

    /**
     *
     * @param \App\Http\Requests\Geo\ZipRequest $request
     * @return mixed
     */
    public function zip(ZipRequest $request)
    {
        $validatedRequest = $request->validated();

        $q = [
            Arr::get($validatedRequest, 'zip_code'),
            Arr::get($validatedRequest, 'country_code'),
        ];

        $query = [
            'zip' => implode(',', $q),
        ];

        return $this->openWeatherService->geoZip($query);
    }

    /**
     *
     * @param \App\Http\Requests\Geo\ReverseRequest $request
     * @return mixed
     */
    public function reverse(ReverseRequest $request)
    {
        return $this->openWeatherService->geoReverse($request->validated());
    }
}
