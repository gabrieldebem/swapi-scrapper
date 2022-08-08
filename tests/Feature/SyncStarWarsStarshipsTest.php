<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use App\Jobs\SyncStarWarsStarships;
use App\Models\Starship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStarWarsStarshipsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanSyncStarWarsStarships()
    {
        $starships = Starship::factory()->count(10)->make();
        $response = [
            'next' => null,
            'results' => $starships,
        ];

        $this->mock(SWApiClient::class)
            ->shouldReceive('getStarships')
            ->withAnyArgs()
            ->andReturn((object) $response);

        dispatch(new SyncStarWarsStarships());

        $this->assertDatabaseCount(Starship::class, 10);
    }
}
