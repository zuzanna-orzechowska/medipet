<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Pet;
use App\Models\Service;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_date' => fake()->dateTimeBetween('now', '+3 month'),
            'status' => 'scheduled',
            'notes' => fake()->paragraph(),
            'client_id' => User::factory(), 
            'doctor_id' => User::factory(),
            'pet_id' => Pet::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
