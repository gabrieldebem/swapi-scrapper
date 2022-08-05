<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class SpeciesTest extends AbstractTestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanListSpecies()
    {
        $species = \App\Models\Species::factory()->count(10)->create();

        $this->actingAs($this->generateUser())
            ->get('/api/species')
            ->assertSuccessful()
            ->assertJson(['data' => $species->toArray()]);
    }

    /** @test */
    public function testCanShowSpecies()
    {
        $species = \App\Models\Species::factory()->create();

        $this->actingAs($this->generateUser())
            ->get("/api/species/{$species->id}")
            ->assertSuccessful()
            ->assertJson($species->toArray());
    }

    public function testCanSyncSpecies()
    {
        Bus::fake(\App\Jobs\SyncStarWarsSpecies::class);

        $this->actingAs($this->generateUser())
            ->post('/api/species/sync')
            ->assertSuccessful();

        Bus::assertDispatched(\App\Jobs\SyncStarWarsSpecies::class);
    }
}
