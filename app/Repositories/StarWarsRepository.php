<?php

namespace App\Repositories;

use App\Clients\SWApiClient;
use App\Contracts\StarWarsRepositoryInterface;
use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;
use App\Models\Starship;
use App\Models\Vehicle;

class StarWarsRepository implements StarWarsRepositoryInterface
{
    public function __construct(private readonly SWApiClient $client)
    {
    }

    public function findPerson(int $id): Person
    {
        $person = Person::find($id);

        if (!$person) {
            $person = $this->createPersonFromExternalProvider($id);
        }

        return $person;
    }

    private function createPersonFromExternalProvider(int $id): Person
    {
        $extPerson = $this->client->getPeople($id);

        return Person::create([
            'id' => $id,
            'name' => $extPerson->name,
            'height' => $extPerson->height,
            'mass' => $extPerson->mass,
            'hair_color' => $extPerson->hair_color,
            'skin_color' => $extPerson->skin_color,
            'eye_color' => $extPerson->eye_color,
            'birth_year' => $extPerson->birth_year,
            'gender' => $extPerson->gender,
        ]);
    }

    public function findPlanets(int $id): Planet
    {
        $planet =  Planet::find($id);

        if (!$planet) {
            $planet = $this->createPlanetFromExternalProvider($id);
        }

        return $planet;
    }

    private function createPlanetFromExternalProvider(int $id): Planet
    {
        $extPlanet = $this->client->getPlanets($id);

        return Planet::create([
            'id' => $id,
            'name' => $extPlanet->name,
            'rotation_period' => $extPlanet->rotation_period,
            'orbital_period' => $extPlanet->orbital_period,
            'diameter' => $extPlanet->diameter,
            'climate' => $extPlanet->climate,
            'gravity' => $extPlanet->gravity,
            'terrain' => $extPlanet->terrain,
            'surface_water' => $extPlanet->surface_water,
            'population' => $extPlanet->population,
        ]);
    }

    public function findVehicles(int $id): Vehicle
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            $vehicle = $this->createVehicleFromExternalProvider($id);
        }

        return $vehicle;
    }

    private function createVehicleFromExternalProvider(int $id): Vehicle
    {
        $extVehicle = $this->client->getVehicles($id);

        return Vehicle::create([
            'id' => $id,
            'name' => $extVehicle->name,
            'model' => $extVehicle->model,
            'manufacturer' => $extVehicle->manufacturer,
            'cost_in_credits' => $extVehicle->cost_in_credits,
            'length' => $extVehicle->length,
            'max_atmosphering_speed' => $extVehicle->max_atmosphering_speed,
            'crew' => $extVehicle->crew,
            'passengers' => $extVehicle->passengers,
            'cargo_capacity' => $extVehicle->cargo_capacity,
            'consumables' => $extVehicle->consumables,
            'vehicle_class' => $extVehicle->vehicle_class,
        ]);
    }

    public function findSpecies(int $id): Species
    {
        $species = Species::find($id);

        if (!$species) {
            $species = $this->createSpeciesFromExternalProvider($id);
        }

        return $species;
    }

    private function createSpeciesFromExternalProvider(int $id): Species
    {
        $extSpecies = $this->client->getSpecies($id);

        return Species::create([
            'id' => $id,
            'name' => $extSpecies->name,
            'classification' => $extSpecies->classification,
            'designation' => $extSpecies->designation,
            'average_height' => $extSpecies->average_height,
            'skin_colors' => $extSpecies->skin_colors,
            'eye_colors' => $extSpecies->eye_colors,
            'average_lifespan' => $extSpecies->average_lifespan,
            'language' => $extSpecies->language,
        ]);
    }

    public function findFilm(int $id): Film
    {
        $film = Film::find($id);

        if (!$film) {
            $film = $this->createFilmFromExternalProvider($id);
        }

        return $film;
    }

    private function createFilmFromExternalProvider(int $id): Film
    {
        $extFilm = $this->client->getFilms($id);

        return Film::create([
            'id' => $id,
            'title' => $extFilm->title,
            'episode_id' => $extFilm->episode_id,
            'opening_crawl' => $extFilm->opening_crawl,
            'director' => $extFilm->director,
            'producer' => $extFilm->producer,
            'release_date' => $extFilm->release_date,
        ]);
    }

    public function findStarships(int $id): Starship
    {
        $starship = Starship::find($id);

        if (!$starship) {
            $starship = $this->createStarshipFromExternalProvider($id);
        }

        return $starship;
    }

    private function createStarshipFromExternalProvider(int $id): Starship
    {
        $extStarship = $this->client->getStarships($id);

        return Starship::create([
            'id' => $id,
            'name' => $extStarship->name,
            'model' => $extStarship->model,
            'manufacturer' => $extStarship->manufacturer,
            'cost_in_credits' => $extStarship->cost_in_credits,
            'length' => $extStarship->length,
            'max_atmosphering_speed' => $extStarship->max_atmosphering_speed,
            'crew' => $extStarship->crew,
            'passengers' => $extStarship->passengers,
            'cargo_capacity' => $extStarship->cargo_capacity,
            'consumables' => $extStarship->consumables,
            'hyperdrive_rating' => $extStarship->hyperdrive_rating,
            'MGLT' => $extStarship->MGLT,
            'starship_class' => $extStarship->starship_class,
        ]);
    }

    public function listPeople(?array $filters = [])
    {
        return $this->client->getPeople(filters: $filters);
    }

    public function listPlanets(?array $filters = [])
    {
        return $this->client->getPlanets(filters: $filters);
    }

    public function listVehicles(?array $filters = [])
    {
        return $this->client->getVehicles(filters: $filters);
    }

    public function listSpecies(?array $filters = [])
    {
        return $this->client->getSpecies(filters: $filters);
    }

    public function listFilms(?array $filters = [])
    {
        return $this->client->getFilms(filters: $filters);
    }

    public function listStarships(?array $filters = [])
    {
        return $this->client->getStarships(filters: $filters);
    }
}
