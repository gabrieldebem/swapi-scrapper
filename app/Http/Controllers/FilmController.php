<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Jobs\SyncStarWarsFilms;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class FilmController extends Controller
{
    public function __construct(private readonly StarWarsRepositoryInterface $starWarsRepository)
    {
    }

    /**
     * @OA\Get(
     *     tags={"Films"},
     *     path="/films",
     *     summary="Get all films",
     *     description="Get all films",
     *     operationId="getFilms",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $films = QueryBuilder::for(Film::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($films);
    }

    /**
     * @OA\Get(
     *     tags={"Films"},
     *     path="/films/{id}",
     *     summary="Get a film",
     *     description="Get a film",
     *     operationId="getFilm",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Film ID",
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
        $film = $this->starWarsRepository->findFilm($id);

        return response()->json($film);
    }

    /**
     * @OA\Post(
     *     tags={"Films"},
     *     path="/films/sync",
     *     summary="Sync all films",
     *     description="Sync all films",
     *     operationId="syncFilms",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsFilms());

        return response()->json(['message' => 'Sync started']);
    }
}
