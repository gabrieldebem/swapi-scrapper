<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Jobs\SyncStarWarsSpecies;
use App\Models\Species;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class SpeciesController extends Controller
{
    public function __construct(private readonly StarWarsRepositoryInterface $starWarsRepository)
    {
    }

    /**
     * @OA\Get(
     *     path="/species",
     *     summary="Get all species",
     *     description="Get all species",
     *     operationId="getAllSpecies",
     *     tags={"Species"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $species = QueryBuilder::for(Species::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($species);
    }

    /**
     * @OA\Get(
     *     path="/species/{id}",
     *     summary="Get a species",
     *     description="Get a species",
     *     operationId="getSpecies",
     *     tags={"Species"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Species ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(response=404, description="Specie not found"),
     * )
     */
    public function show(int $id): JsonResponse
    {
        $species = $this->starWarsRepository->findSpecies($id);

        return response()->json($species);
    }

    /**
     * @OA\Post(
     *     path="/species/sync",
     *     summary="Sync all species",
     *     description="Sync all species",
     *     operationId="syncAllSpecies",
     *     tags={"Species"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     * )
     */
    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsSpecies());

        return response()->json(['message' => 'Sync started']);
    }
}
