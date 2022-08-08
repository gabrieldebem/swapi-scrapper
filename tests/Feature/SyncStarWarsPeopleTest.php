<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use App\Jobs\SyncStarWarsPeople;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SyncStarWarsPeopleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanSyncStarWarsPeople()
    {
        $people = Person::factory()->count(10)->make();
        $response = [
            'next' => null,
            'results' => $people,
        ];

        $this->mock(SWApiClient::class)
            ->shouldReceive('getPeople')
            ->withAnyArgs()
            ->andReturn((object) $response);

        dispatch(new SyncStarWarsPeople());

        $this->assertDatabaseCount('people', 10);
    }
}
