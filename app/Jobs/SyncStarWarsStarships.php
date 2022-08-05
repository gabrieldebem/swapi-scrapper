<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Starship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsStarships implements ShouldQueue
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
            $starships = $repository->listStarships(['page' => $page]);

            foreach ($starships->results as $starship) {
                Starship::firstOrCreate([
                    'name' => $starship->name,
                    'model' => $starship->model,
                    'manufacturer' => $starship->manufacturer,
                    'cost_in_credits' => $starship->cost_in_credits,
                    'length' => $starship->length,
                    'max_atmosphering_speed' => $starship->max_atmosphering_speed,
                    'crew' => $starship->crew,
                    'passengers' => $starship->passengers,
                    'cargo_capacity' => $starship->cargo_capacity,
                    'consumables' => $starship->consumables,
                    'hyperdrive_rating' => $starship->hyperdrive_rating,
                    'MGLT' => $starship->MGLT,
                    'starship_class' => $starship->starship_class,
                ]);
            }

            $page++;
        } while ((bool) $starships->next);
    }
}
