<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use App\Jobs\SyncStarWarsPlanets;
use App\Models\Planet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStarWarsPlanetsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanSyncStarWarsPlanets()
    {
        $planets = Planet::factory()->count(10)->make();
        $response = [
            'next' => null,
            'results' => $planets,
        ];

        $this->mock(SWApiClient::class)
            ->shouldReceive('getPlanets')
            ->withAnyArgs()
            ->andReturn((object) $response);

        dispatch(new SyncStarWarsPlanets());

        $this->assertDatabaseCount('planets', 10);
    }
}
