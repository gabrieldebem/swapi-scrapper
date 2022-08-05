<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Species;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsSpecies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StarWarsRepositoryInterface $repository)
    {
        $page = 1;

        do {
            $species = $repository->listSpecies(['page' => $page]);

            foreach ($species->results as $specie) {
                Species::firstOrCreate([
                    'name' => $specie->name,
                    'classification' => $specie->classification,
                    'designation' => $specie->designation,
                    'average_height' => $specie->average_height,
                    'skin_colors' => $specie->skin_colors,
                    'eye_colors' => $specie->eye_colors,
                    'average_lifespan' => $specie->average_lifespan,
                    'language' => $specie->language,
                ]);
            }

            $page++;
        } while ((bool) $species->next);
    }
}
