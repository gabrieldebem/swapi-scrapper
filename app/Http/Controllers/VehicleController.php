<?php

namespace App\Http\Controllers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Jobs\SyncStarWarsVehicles;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class VehicleController extends Controller
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
        $vehicles = QueryBuilder::for(Vehicle::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($vehicles);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $vehicle = $this->starWarsRepository->findVehicles($id);

        return response()->json($vehicle);
    }

    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsVehicles());

        return response()->json(['message' => 'Sync started']);
    }
}
