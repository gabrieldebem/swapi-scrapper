<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Species>
 */
class SpeciesFactory extends Factory
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
            'classification' => $this->faker->name(),
            'designation' => $this->faker->name(),
            'average_height' => $this->faker->name(),
            'skin_colors' => $this->faker->colorName(),
            'eye_colors' => $this->faker->colorName(),
            'average_lifespan' => $this->faker->text(10),
            'language'  => $this->faker->text(10),
        ];
    }
}
