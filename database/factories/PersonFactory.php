<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
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
            'height' => $this->faker->numberBetween(1, 300),
            'mass' => $this->faker->numberBetween(1, 300),
            'hair_color' => $this->faker->word,
            'skin_color' => $this->faker->colorName(),
            'eye_color' => $this->faker->colorName(),
            'birth_year' => $this->faker->year(),
            'gender' => 'male',
        ];
    }
}
