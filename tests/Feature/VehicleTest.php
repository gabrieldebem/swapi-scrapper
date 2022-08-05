<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class VehicleTest extends AbstractTestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanListVehicles()
    {
        $vehicles = \App\Models\Vehicle::factory()->count(10)->create();

        $this->actingAs($this->generateUser())
            ->get('/api/vehicles')
            ->assertSuccessful()
            ->assertJson(['data' => $vehicles->toArray()]);
    }

    /** @test */
    public function testCanShowVehicle()
    {
        $vehicle = \App\Models\Vehicle::factory()->create();

        $this->actingAs($this->generateUser())
            ->get("/api/vehicles/{$vehicle->id}")
            ->assertSuccessful()
            ->assertJson($vehicle->toArray());
    }

    public function testCanSyncVehicles()
    {
        Bus::fake(\App\Jobs\SyncStarWarsVehicles::class);

        $this->actingAs($this->generateUser())
            ->post('/api/vehicles/sync')
            ->assertSuccessful();

        Bus::assertDispatched(\App\Jobs\SyncStarWarsVehicles::class);
    }
}
