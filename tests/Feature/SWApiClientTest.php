<?php

namespace Tests\Feature;

use App\Clients\SWApiClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class SWApiClientTest extends TestCase
{
    private string $url;
    private SWApiClient $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->url = config('services.sw_api.url');
        $this->client = new SWApiClient();
    }

    /** @test */
    public function testCanGetFilms()
    {
        $url = $this->url . 'films/1';
        $fakeResponse = ['response' => 'fake'];

        Http::fake([
            $url => Http::response($fakeResponse),
        ]);

        $response = $this->client->getFilms(1);

        Http::assertSent(function (Request $request) use ($url) {
            $this->assertEquals($request->url(), $url);

            return true;
        });

        $this->assertEquals($response, (object) $fakeResponse);
    }

    /** @test */
    public function testCanGetPeople()
    {
        $url = $this->url . 'people/1';
        $fakeResponse = ['response' => 'fake'];

        Http::fake([
            $url => Http::response($fakeResponse),
        ]);

        $response = $this->client->getPeople(1);

        Http::assertSent(function (Request $request) use ($url) {
            $this->assertEquals($request->url(), $url);

            return true;
        });

        $this->assertEquals($response, (object) $fakeResponse);
    }

    /** @test */
    public function testCanGetPlanets()
    {
        $url = $this->url . 'planets/1';
        $fakeResponse = ['response' => 'fake'];

        Http::fake([
            $url => Http::response($fakeResponse),
        ]);

        $response = $this->client->getPlanets(1);

        Http::assertSent(function (Request $request) use ($url) {
            $this->assertEquals($request->url(), $url);

            return true;
        });

        $this->assertEquals($response, (object) $fakeResponse);
    }

    /** @test */
    public function testCanGetSpecies()
    {
        $url = $this->url . 'species/1';
        $fakeResponse = ['response' => 'fake'];

        Http::fake([
            $url => Http::response($fakeResponse),
        ]);

        $response = $this->client->getSpecies(1);

        Http::assertSent(function (Request $request) use ($url) {
            $this->assertEquals($request->url(), $url);

            return true;
        });

        $this->assertEquals($response, (object) $fakeResponse);
    }

    /** @test */
    public function testCanGetStarships()
    {
        $url = $this->url . 'starships/1';
        $fakeResponse = ['response' => 'fake'];

        Http::fake([
            $url => Http::response($fakeResponse),
        ]);

        $response = $this->client->getStarships(1);

        Http::assertSent(function (Request $request) use ($url) {
            $this->assertEquals($request->url(), $url);

            return true;
        });

        $this->assertEquals($response, (object) $fakeResponse);
    }

    /** @test */
    public function testCanGetVehicles()
    {
        $url = $this->url . 'vehicles/1';
        $fakeResponse = ['response' => 'fake'];

        Http::fake([
            $url => Http::response($fakeResponse),
        ]);

        $response = $this->client->getVehicles(1);

        Http::assertSent(function (Request $request) use ($url) {
            $this->assertEquals($request->url(), $url);

            return true;
        });

        $this->assertEquals($response, (object) $fakeResponse);
    }
}
