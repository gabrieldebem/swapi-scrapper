<?php

namespace Tests\Feature;

use App\Jobs\SyncStarWarsFilms;
use App\Jobs\SyncStarWarsPeople;
use App\Jobs\SyncStarWarsPlanets;
use App\Jobs\SyncStarWarsSpecies;
use App\Jobs\SyncStarWarsStarships;
use App\Jobs\SyncStarWarsVehicles;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class SyncAllEntitiesTest extends AbstractTestCase
{
    /** @test */
    public function testSyncAllEntitiesDispatchCorrectlyJobs()
    {
        Bus::fake([
            SyncStarWarsFilms::class,
            SyncStarWarsPeople::class,
            SyncStarWarsPlanets::class,
            SyncStarWarsSpecies::class,
            SyncStarWarsStarships::class,
            SyncStarWarsVehicles::class,
        ]);

        $this->actingAs($this->generateUser())
            ->post('/api/sync')
            ->assertSuccessful()
            ->assertJson(['message' => 'Sync started']);
    }
}
