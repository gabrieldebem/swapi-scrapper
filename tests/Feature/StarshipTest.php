<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AbstractTestCase;
use Tests\TestCase;

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
}
