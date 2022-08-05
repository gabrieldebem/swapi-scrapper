<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Starship>
 */
class StarshipFactory extends Factory
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
            'model' => $this->faker->name(),
            'manufacturer' => $this->faker->name(),
            'cost_in_credits' => $this->faker->name(),
            'length' => (string) $this->faker->randomFloat(),
            'max_atmosphering_speed' => (string) $this->faker->randomFloat(),
            'crew' => (string) $this->faker->numberBetween(10, 100),
            'passengers' => $this->faker->name(),
            'cargo_capacity' => $this->faker->name(),
            'consumables' => $this->faker->name(),
            'hyperdrive_rating' => $this->faker->name(),
            'MGLT' => $this->faker->name(),
            'starship_class' => $this->faker->name(),

        ];
    }
}
