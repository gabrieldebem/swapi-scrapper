<?php

namespace App\Clients;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class SWApiClient extends StarWarsBaseClient
{
    public function getFilms(?int $id = null, ?array $filters = []): object
    {
        try {
            $response = $this->client()
                ->get("/films/{$id}", $filters)
                ->object();
        } catch (Throwable $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $response;
    }

    public function getPeople(?int $id = null, ?array $filters = []): object
    {
        try {
            $response = $this->client()
                ->get("/people/{$id}", $filters)
                ->object();
        } catch (Throwable $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $response;
    }

    public function getPlanets(?int $id = null, ?array $filters = []): object
    {
        try {
            $response = $this->client()
                ->get("/planets/{$id}", $filters)
                ->object();
        } catch (Throwable $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $response;
    }

    public function getSpecies(?int $id = null, ?array $filters = []): object
    {
        try {
            $response = $this->client()
                ->get("/species/{$id}", $filters)
                ->object();
        } catch (Throwable $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $response;
    }

    public function getStarships(?int $id = null, ?array $filters = []): object
    {
        try {
            $response = $this->client()
                ->get("/starships/{$id}", $filters)
                ->object();
        } catch (Throwable $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $response;
    }

    public function getVehicles(?int $id = null, ?array $filters = []): object
    {
        try {
            $response = $this->client()
                ->get("/vehicles/{$id}", $filters)
                ->object();
        } catch (Throwable $e) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }

        return $response;
    }
}
