<?php

namespace Tests\Feature;

use App\Jobs\SyncStarWarsFilms;
use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class FilmTest extends AbstractTestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanListFilms()
    {
        $films = Film::factory()->count(10)->create();

        $this->actingAs($this->generateUser())
            ->get('/api/films')
            ->assertSuccessful()
            ->assertJson(['data' => $films->toArray()]);
    }

    /** @test */
    public function testCanShowFilm()
    {
        $film = Film::factory()->create();
        $this->actingAs($this->generateUser())
            ->get("/api/films/{$film->id}")
            ->assertSuccessful()
            ->assertJson($film->toArray());
    }

    /** @test */
    public function testCanSyncFilms()
    {
        Bus::fake(SyncStarWarsFilms::class);
        $this->actingAs($this->generateUser())
            ->post('/api/films/sync')
            ->assertSuccessful();
        Bus::assertDispatched(SyncStarWarsFilms::class);
    }
}
