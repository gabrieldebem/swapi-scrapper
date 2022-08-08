<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use App\Jobs\SyncStarWarsVehicles;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStarWarsVehiclesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanSyncStarWarsVehicles()
    {
        $vehicles = Vehicle::factory()->count(10)->make();
        $response = [
            'next' => null,
            'results' => $vehicles,
        ];

        $this->mock(SWApiClient::class)
            ->shouldReceive('getVehicles')
            ->withAnyArgs()
            ->andReturn((object) $response);

        dispatch(new SyncStarWarsVehicles());

        $this->assertDatabaseCount(Vehicle::class, 10);
    }
}
