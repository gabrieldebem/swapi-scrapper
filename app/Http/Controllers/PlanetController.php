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
     *
     * @OA\Get(
     *     path="/planets",
     *     summary="List all sw planets",
     *     tags={"Planets"},
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ),
     * ),
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
     *
     * @OA\Get(
     *     path="/planets/{id}",
     *     summary="Show sw planet",
     *     tags={"Planets"},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Planet id",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *    ),
     *     @OA\Response(response=200, description="successful operation"),
     * )
     */
    public function show(int $id): JsonResponse
    {
        $planet = $this->starWarsRepository->findPlanet($id);

        return response()->json($planet);
    }

    /**
     * Sync sw planets.
     *
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/planets/sync",
     *     summary="Sync sw planets",
     *     tags={"Planets"},
     *     @OA\Response(response=200, description="successful operation"),
     * )
     */
    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsPlanets());

        return response()->json(['message' => 'Sync started']);
    }
}
