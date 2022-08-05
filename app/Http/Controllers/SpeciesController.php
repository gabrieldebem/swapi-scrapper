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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $species = QueryBuilder::for(Species::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($species);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $species = $this->starWarsRepository->findSpecies($id);

        return response()->json($species);
    }

    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsSpecies());

        return response()->json(['message' => 'Sync started']);
    }
}
