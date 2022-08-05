<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Planet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsPlanets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StarWarsRepositoryInterface $repository): void
    {
        $page = 1;

        do {
            $planets = $repository->listPlanets(['page' => $page]);

            foreach ($planets->results as $planet) {
                Planet::firstOrCreate([
                    'name' => $planet->name,
                    'rotation_period' => $planet->rotation_period,
                    'orbital_period' => $planet->orbital_period,
                    'diameter' => $planet->diameter,
                    'climate' => $planet->climate,
                    'gravity' => $planet->gravity,
                    'terrain' => $planet->terrain,
                    'surface_water' => $planet->surface_water,
                    'population' => $planet->population,
                ]);
            }

            $page++;
        } while ((bool) $planets->next);
    }
}
