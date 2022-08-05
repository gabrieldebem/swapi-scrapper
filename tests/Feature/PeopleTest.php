<?php

namespace Tests\Feature;

use App\Jobs\SyncStarWarsPeople;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\AbstractTestCase;

class PeopleTest extends AbstractTestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCanListPeople()
    {
        $people = Person::factory()->count(10)->create();

        $this->actingAs($this->generateUser())
            ->get('/api/people')
            ->assertSuccessful()
            ->assertJson(['data' => $people->toArray()]);
    }

    /** @test */
    public function testCanShowPeople()
    {
        $people = Person::factory()->create();

        $this->actingAs($this->generateUser())
            ->get("/api/people/{$people->id}")
            ->assertSuccessful()
            ->assertJson($people->toArray());
    }

    public function testCanSyncPeople()
    {
        Bus::fake(SyncStarWarsPeople::class);

        $this->actingAs($this->generateUser())
            ->post('/api/people/sync')
            ->assertSuccessful();

        Bus::assertDispatched(SyncStarWarsPeople::class);
    }
}
