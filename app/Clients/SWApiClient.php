<?php

namespace App\Clients;

class SWApiClient extends StarWarsBaseClient
{
    public function getFilms(?int $id = null, ?array $filters = []): object
    {
        return $this->client()
            ->get("/films/{$id}", $filters)
            ->object();
    }

    public function getPeople(?int $id = null, ?array $filters = []): object
    {
        return $this->client()
            ->get("/people/{$id}", $filters)
            ->object();
    }

    public function getPlanets(?int $id = null, ?array $filters = []): object
    {
        return $this->client()
            ->get("/planets/{$id}", $filters)
            ->object();
    }

    public function getSpecies(?int $id = null, ?array $filters = []): object
    {
        return $this->client()
            ->get("/species/{$id}", $filters)
            ->object();
    }

    public function getStarships(?int $id = null, ?array $filters = []): object
    {
        return $this->client()
            ->get("/starships/{$id}", $filters)
            ->object();
    }

    public function getVehicles(?int $id = null, ?array $filters = []): object
    {
        return $this->client()
            ->get("/vehicles/{$id}", $filters)
            ->object();
    }
}
