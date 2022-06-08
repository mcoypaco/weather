<?php

use App\Http\Controllers\GeoController;
use App\Http\Controllers\WeatherForecastController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('geo')->group(function () {
    Route::get('direct', [GeoController::class, 'direct']);
    Route::get('reverse', [GeoController::class, 'reverse']);
    Route::get('zip', [GeoController::class, 'zip']);
});

Route::prefix('weather-forecast')->group(function () {
    Route::get('forecast', [WeatherForecastController::class, 'forecast']);
    Route::get('weather', [WeatherForecastController::class, 'weather']);
});
