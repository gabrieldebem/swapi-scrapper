<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Jobs\SyncStarWarsStarships;
use App\Models\Starship;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class StarshipController extends Controller
{
    public function __construct(private readonly StarWarsRepositoryInterface $starWarsRepository)
    {
    }

    /**
     * @OA\Get(
     *     tags={"Starships"},
     *     path="/starships",
     *     summary="Get all starships",
     *     description="Get all starships",
     *     operationId="getStarships",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $starships = QueryBuilder::for(Starship::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($starships);
    }

    /**
     * @OA\Get(
     *     tags={"Starships"},
     *     path="/starships/{id}",
     *     summary="Get a starship",
     *     description="Get a starship",
     *     operationId="getStarship",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Starship ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function show(int $id): JsonResponse
    {
        $starship = $this->starWarsRepository->findStarships($id);

        return response()->json($starship);
    }

    /**
     * @OA\Post(
     *     tags={"Starships"},
     *     path="/starships/sync",
     *     summary="Sync all starships",
     *     description="Sync all starships",
     *     operationId="syncStarships",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsStarships());

        return response()->json(['message' => 'Sync started']);
    }
}
