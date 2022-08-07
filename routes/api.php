<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PlanetController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\StarshipController;
use App\Http\Controllers\SyncAllEntities;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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

Route::post('/users', [UserController::class, 'store']);
Route::post('/users/auth', [UserController::class, 'auth']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/me', [UserController::class, 'me']);
    Route::post('/sync', SyncAllEntities::class);


    Route::get('/people', [PersonController::class, 'index']);
    Route::get('/people/{id}', [PersonController::class, 'show']);
    Route::post('/people/sync', [PersonController::class, 'sync']);

    Route::get('/films', [FilmController::class, 'index']);
    Route::get('/films/{id}', [FilmController::class, 'show']);
    Route::post('/films/sync', [FilmController::class, 'sync']);

    Route::get('/planets', [PlanetController::class, 'index']);
    Route::get('/planets/{id}', [PlanetController::class, 'show']);
    Route::post('/planets/sync', [PlanetController::class, 'sync']);

    Route::get('/species', [SpeciesController::class, 'index']);
    Route::get('/species/{id}', [SpeciesController::class, 'show']);
    Route::post('/species/sync', [SpeciesController::class, 'sync']);

    Route::get('/starships', [StarshipController::class, 'index']);
    Route::get('/starships/{id}', [StarshipController::class, 'show']);
    Route::post('/starships/sync', [StarshipController::class, 'sync']);

    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicles/{id}', [VehicleController::class, 'show']);
    Route::post('/vehicles/sync', [VehicleController::class, 'sync']);
});
