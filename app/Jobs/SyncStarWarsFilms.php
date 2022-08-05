<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Film;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsFilms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StarWarsRepositoryInterface $repository)
    {
        $page = 1;

        do {
            $films = $repository->listFilms(['page' => $page]);

            foreach ($films->results as $film) {
                Film::firstOrCreate([
                    'title' => $film->title,
                    'episode_id' => $film->episode_id,
                    'opening_crawl' => $film->opening_crawl,
                    'director' => $film->director,
                    'producer' => $film->producer,
                    'release_date' => $film->release_date,
                ]);
            }

            $page++;
        } while ((bool) $films->next);
    }
}
