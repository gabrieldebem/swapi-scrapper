<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
