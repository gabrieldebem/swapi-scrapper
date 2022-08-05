<?php

namespace App\Clients;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class StarWarsBaseClient
{
    protected function client(): PendingRequest
    {
        return Http::baseUrl(config('services.sw_api.url'));
    }
}
