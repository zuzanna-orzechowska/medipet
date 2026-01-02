<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'species' => fake()->randomElement(['Pies', 'Kot', 'Chomik', 'Papuga', 'Fretka', 'Jeż', 'Królik', 'Świnka morska']),
            'breed' => fake()->word(),
            'birth_date' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
        ];
    }
}
