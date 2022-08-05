<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Starship;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class StarshipController extends Controller
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
        $starships = QueryBuilder::for(Starship::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($starships);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $starship = $this->starWarsRepository->findStarship($id);

        return response()->json($starship);
    }
}
