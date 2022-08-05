<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsPeople implements ShouldQueue
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
            $people = $repository
                ->listPeople(['page' => $page]);

            foreach ($people->results as $person) {
                Person::firstOrCreate([
                    'name' => $person->name,
                    'height' => $person->height,
                    'mass' => $person->mass,
                    'hair_color' => $person->hair_color,
                    'skin_color' => $person->skin_color,
                    'eye_color' => $person->eye_color,
                    'birth_year' => $person->birth_year,
                    'gender' => $person->gender,
                ]);
            }

            $page++;
        } while ((bool) $people->next);
    }
}
