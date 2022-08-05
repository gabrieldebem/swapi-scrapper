<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsVehicles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @param  StarWarsRepositoryInterface  $repository
     * @return void
     */
    public function handle(StarWarsRepositoryInterface $repository): void
    {
        $page = 1;

        do {
            $vehicles = $repository->listVehicles(['page' => $page]);

            foreach ($vehicles->results as $vehicle) {
                Vehicle::firstOrCreate([
                    'name' => $vehicle->name,
                    'model' => $vehicle->model,
                    'manufacturer' => $vehicle->manufacturer,
                    'cost_in_credits' => $vehicle->cost_in_credits,
                    'length' => $vehicle->length,
                    'max_atmosphering_speed' => $vehicle->max_atmosphering_speed,
                    'crew' => $vehicle->crew,
                    'passengers' => $vehicle->passengers,
                    'cargo_capacity' => $vehicle->cargo_capacity,
                    'consumables' => $vehicle->consumables,
                    'vehicle_class' => $vehicle->vehicle_class,
                ]);
            }

            $page++;
        } while ((bool) $vehicles->next);
    }
}
