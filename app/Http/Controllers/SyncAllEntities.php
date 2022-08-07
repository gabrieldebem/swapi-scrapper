<?php

namespace App\Http\Controllers;

use App\Jobs\SyncStarWarsFilms;
use App\Jobs\SyncStarWarsPeople;
use App\Jobs\SyncStarWarsPlanets;
use App\Jobs\SyncStarWarsSpecies;
use App\Jobs\SyncStarWarsStarships;
use App\Jobs\SyncStarWarsVehicles;
use Illuminate\Http\JsonResponse;

class SyncAllEntities extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Sync Entities"},
     *     summary="Sync all entities",
     *     description="Sync all entities using an external api",
     *     path="/sync",
     *     security={{"Bearer":{}}},
     *     @OA\Response(
     *     response=200,
     *     description="Success",
     *   ),
     * )
     */
    public function __invoke(): JsonResponse
    {
        dispatch(new SyncStarWarsFilms());
        dispatch(new SyncStarWarsPeople());
        dispatch(new SyncStarWarsPlanets());
        dispatch(new SyncStarWarsSpecies());
        dispatch(new SyncStarWarsStarships());
        dispatch(new SyncStarWarsVehicles());

        return response()->json(['message' => 'Sync started']);
    }
}
