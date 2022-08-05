<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'climate' => $this->faker->name(),
            'terrain' => $this->faker->name(),
            'surface_water' => $this->faker->name(),
            'population' => $this->faker->name(),
            'rotation_period' => $this->faker->name(),
            'orbital_period' => $this->faker->name(),
            'diameter' => (string) $this->faker->randomFloat(),
            'gravity' => (string) $this->faker->randomFloat(),
        ];
    }
}
