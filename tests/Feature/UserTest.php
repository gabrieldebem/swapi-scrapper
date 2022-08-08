<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function testCanCreateUser()
    {
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
        ];

        $this->post('/api/users', $data)
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

        $this->assertDatabaseHas(User::class, [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function testCanAuthUser()
    {
        $data = [
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'device' => 'mobile',
        ];

        User::factory()->create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->post('/api/users/auth', $data)
            ->assertSuccessful();
    }

    public function testCantAuthUserWithInvalidCredentials()
    {
        $data = [
            'email' => $this->faker->safeEmail(),
            'password' => 'password',
            'device' => 'mobile',
        ];

        $this->post('/api/users/auth', $data)
            ->assertUnauthorized()
            ->assertJson([
                'message' => trans('auth.failed'),
            ]);
    }

    public function testCanGetAuthUser()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/api/users/me')
            ->assertSuccessful()
            ->assertJson($user->toArray());
    }
}
