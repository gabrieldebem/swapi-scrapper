<?php

namespace App\Contracts;

use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;
use App\Models\Starship;
use App\Models\Vehicle;

interface StarWarsRepositoryInterface
{
    public function findPerson(int $id): Person;

    public function findPlanet(int $id): Planet;

    public function findVehicles(int $id): Vehicle;

    public function findSpecies(int $id): Species;

    public function findFilm(int $id): Film;

    public function findStarships(int $id): Starship;

    public function listPeople();

    public function listPlanets();

    public function listVehicles();

    public function listSpecies();

    public function listFilms();

    public function listStarships();
}
