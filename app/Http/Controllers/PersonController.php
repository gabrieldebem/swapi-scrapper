<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Jobs\SyncStarWarsFilms;
use App\Jobs\SyncStarWarsPeople;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class PersonController extends Controller
{
    public function __construct(private readonly StarWarsRepositoryInterface $starWarsService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $people = QueryBuilder::for(Person::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($people);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $person = $this->starWarsService->findPerson($id);

        return response()->json($person);
    }

    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsPeople());

        return response()->json(['message' => 'Sync started']);
    }
}
