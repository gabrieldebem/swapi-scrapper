<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use App\Jobs\SyncStarWarsSpecies;
use App\Models\Species;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStarWarsSpeciesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanSyncStarWarsSpecies()
    {
        $species = Species::factory()->count(10)->make();
        $response = [
            'next' => null,
            'results' => $species,
        ];

        $this->mock(SWApiClient::class)
            ->shouldReceive('getSpecies')
            ->withAnyArgs()
            ->andReturn((object) $response);

        dispatch(new SyncStarWarsSpecies());

        $this->assertDatabaseCount(Species::class, 10);
    }
}
