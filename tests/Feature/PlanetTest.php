<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class PlanetTest extends AbstractTestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanListPlanets()
    {
        $planets = \App\Models\Planet::factory()->count(10)->create();
        $this->actingAs($this->generateUser())
            ->get('/api/planets')
            ->assertSuccessful()
            ->assertJson(['data' => $planets->toArray()]);
    }

    /** @test */
    public function testCanShowPlanet()
    {
        $planet = \App\Models\Planet::factory()->create();
        $this->actingAs($this->generateUser())
            ->get("/api/planets/{$planet->id}")
            ->assertSuccessful()
            ->assertJson($planet->toArray());
    }

    public function testCanSyncPlanets()
    {
        Bus::fake(\App\Jobs\SyncStarWarsPlanets::class);

        $this->actingAs($this->generateUser())
            ->post('/api/planets/sync')
            ->assertSuccessful();

        Bus::assertDispatched(\App\Jobs\SyncStarWarsPlanets::class);
    }
}
