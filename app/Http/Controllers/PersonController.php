<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
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
     *
     * @OA\Get(
     *     path="/people",
     *     summary="Get all people",
     *     tags={"People"},
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ),
     * ),
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
     *
     * @OA\Get(
     *     path="/people/{id}",
     *     summary="Get a person",
     *     tags={"People"},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="SW Person ID",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64"),
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ),
     * ),
     */
    public function show(int $id): JsonResponse
    {
        $person = $this->starWarsService->findPerson($id);

        return response()->json($person);
    }

    /**
     * Sync all people.
     *
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/people/sync",
     *     summary="Sync all people",
     *     tags={"People"},
     *     @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     ),
     * ),
     */
    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsPeople());

        return response()->json(['message' => 'Sync started']);
    }
}
