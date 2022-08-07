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
     * @OA\Get(
     *     tags={"Vehicles"},
     *     path="/vehicles",
     *     summary="Get all vehicles",
     *     description="Get all vehicles",
     *     operationId="getVehicles",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $vehicles = QueryBuilder::for(Vehicle::class)
            ->defaultSort('created_at')
            ->paginate();

        return response()->json($vehicles);
    }

    /**
     * @OA\Get(
     *     tags={"Vehicles"},
     *     path="/vehicles/{id}",
     *     summary="Get a vehicle",
     *     description="Get a vehicle",
     *     operationId="getVehicle",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Vehicle ID",
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
        $vehicle = $this->starWarsRepository->findVehicles($id);

        return response()->json($vehicle);
    }

    /**
     * @OA\Post(
     *     tags={"Vehicles"},
     *     path="/vehicles/sync",
     *     summary="Sync vehicles",
     *     description="Sync vehicles",
     *     operationId="syncVehicles",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function sync(): JsonResponse
    {
        dispatch(new SyncStarWarsVehicles());

        return response()->json(['message' => 'Sync started']);
    }
}
