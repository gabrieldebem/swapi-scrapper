<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Jobs\SyncStarWarsPlanets;
use App\Models\Planet;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class PlanetController extends Controller
{
    public function __construct(private readonly StarWarsRepositoryInterface $starWarsRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $planets = QueryBuilder::for(Planet::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($planets);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $planet = $this->starWarsRepository->findPlanet($id);

        return response()->json($planet);
    }

    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsPlanets());

        return response()->json(['message' => 'Sync started']);
    }
}
