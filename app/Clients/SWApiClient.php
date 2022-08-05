<?php

namespace App\Clients;

class SWApiClient extends StarWarsBaseClient
{
    public function getFilms(?int $id = null): object
    {
        return $this->client()
            ->get("/films/{$id}")
            ->object();
    }

    public function getPeople(?int $id = null): object
    {
        return $this->client()
            ->get("/people/{$id}")
            ->object();
    }

    public function getPlanets(?int $id = null): object
    {
        return $this->client()
            ->get("/planets/{$id}")
            ->object();
    }

    public function getSpecies(?int $id = null): object
    {
        return $this->client()
            ->get("/species/{$id}")
            ->object();
    }

    public function getStarships(?int $id = null): object
    {
        return $this->client()
            ->get("/starships/{$id}")
            ->object();
    }

    public function getVehicles(?int $id = null): object
    {
        return $this->client()
            ->get("/vehicles/{$id}")
            ->object();
    }
}
