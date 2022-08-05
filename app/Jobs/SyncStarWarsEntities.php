<?php

namespace App\Jobs;

use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;
use App\Models\Starship;
use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncStarWarsEntities implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private StarWarsRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app(StarWarsRepositoryInterface::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->syncPeople();
        $this->syncPlanets();
        $this->syncVehicles();
        $this->syncSpecies();
        $this->syncFilms();
        $this->syncStarships();
    }

    private function syncPeople(): void
    {
        $page = 1;

        do {
            $people = $this->repository
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
        } while((bool) $people->next);
    }

    private function syncPlanets(): void
    {
        $page = 1;

        do {
            $planets = $this->repository->listPlanets(['page' => $page]);

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
        } while((bool) $planets->next);
    }

    private function syncVehicles(): void
    {
        $page = 1;

        do {
            $vehicles = $this->repository->listVehicles(['page' => $page]);

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
        } while((bool) $vehicles->next);
    }

    private function syncSpecies(): void
    {
        $page = 1;

        do {
            $species = $this->repository->listSpecies(['page' => $page]);

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
        } while((bool) $species->next);
    }

    private function syncFilms(): void
    {
        $page = 1;

        do {
            $films = $this->repository->listFilms(['page' => $page]);

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
        } while((bool) $films->next);
    }

    private function syncStarships(): void
    {
        $page = 1;

        do {
            $starships = $this->repository->listStarships(['page' => $page]);

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
        } while((bool) $starships->next);
    }
}
