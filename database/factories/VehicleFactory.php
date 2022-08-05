<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'model' => $this->faker->name,
            'manufacturer' => $this->faker->name,
            'cost_in_credits' => (string) $this->faker->numberBetween(1, 1000000),
            'length' => (string) $this->faker->numberBetween(1, 100),
            'max_atmosphering_speed' => (string) $this->faker->numberBetween(1, 100),
            'crew' => (string) $this->faker->numberBetween(1, 100),
            'passengers' => (string) $this->faker->numberBetween(1, 100),
            'cargo_capacity' => (string) $this->faker->numberBetween(1, 100),
            'consumables' => $this->faker->name,
            'vehicle_class' => $this->faker->name,
        ];
    }
}
