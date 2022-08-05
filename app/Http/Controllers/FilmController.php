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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $films = QueryBuilder::for(Film::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($films);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $film = $this->starWarsRepository->findFilm($id);

        return response()->json($film);
    }

    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsFilms());

        return response()->json(['message' => 'Sync started']);
    }
}
