<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class StarshipTest extends AbstractTestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanListStarships()
    {
        $starships = \App\Models\Starship::factory()->count(10)->create();

        $this->actingAs($this->generateUser())
            ->get('/api/starships')
            ->assertSuccessful()
            ->assertJson(['data' => $starships->toArray()]);
    }

    /** @test */
    public function testCanShowStarship()
    {
        $starship = \App\Models\Starship::factory()->create();

        $this->actingAs($this->generateUser())
            ->get("/api/starships/{$starship->id}")
            ->assertSuccessful()
            ->assertJson($starship->toArray());
    }

    public function testCanSyncStarships()
    {
        Bus::fake(\App\Jobs\SyncStarWarsStarships::class);

        $this->actingAs($this->generateUser())
            ->post('/api/starships/sync')
            ->assertSuccessful();

        Bus::assertDispatched(\App\Jobs\SyncStarWarsStarships::class);
    }
}
