<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'episode_id' => (string) $this->faker->numberBetween(1, 9),
            'opening_crawl' => $this->faker->text(),
            'director' => $this->faker->name(),
            'producer' => $this->faker->name(),
            'release_date' => (string) $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
        ];
    }
}
