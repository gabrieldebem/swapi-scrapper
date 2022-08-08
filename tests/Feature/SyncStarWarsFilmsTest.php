<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use App\Jobs\SyncStarWarsFilms;
use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStarWarsFilmsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanSyncStarWarsFilms()
    {
        $films = Film::factory()->count(10)->make();
        $response = [
            'next' => null,
            'results' => $films,
        ];

        $this->mock(SWApiClient::class)
            ->shouldReceive('getFilms')
            ->withAnyArgs()
            ->andReturn((object) $response);

        dispatch(new SyncStarWarsFilms());

        $this->assertDatabaseCount('films', 10);
    }
}
