<?php

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

Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
Route::post('/users/auth', [\App\Http\Controllers\UserController::class, 'auth']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/me', [\App\Http\Controllers\UserController::class, 'me']);

    Route::get('/people', [\App\Http\Controllers\PersonController::class, 'index']);
    Route::get('/people/{id}', [\App\Http\Controllers\PersonController::class, 'show']);

    Route::get('/films', [\App\Http\Controllers\FilmController::class, 'index']);
    Route::get('/films/{id}', [\App\Http\Controllers\FilmController::class, 'show']);

    Route::get('/planets', [\App\Http\Controllers\PlanetController::class, 'index']);
    Route::get('/planets/{id}', [\App\Http\Controllers\PlanetController::class, 'show']);

    Route::get('/species', [\App\Http\Controllers\SpeciesController::class, 'index']);
    Route::get('/species/{id}', [\App\Http\Controllers\SpeciesController::class, 'show']);

    Route::get('/starships', [\App\Http\Controllers\StarshipController::class, 'index']);
    Route::get('/starships/{id}', [\App\Http\Controllers\StarshipController::class, 'show']);

    Route::get('/vehicles', [\App\Http\Controllers\VehicleController::class, 'index']);
    Route::get('/vehicles/{id}', [\App\Http\Controllers\VehicleController::class, 'show']);
});
