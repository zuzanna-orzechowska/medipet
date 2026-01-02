<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'lekarz']);
        $clientRole = Role::create(['name' => 'klient']);
        $services = Service::factory(5)->create();

        User::factory()->create([
            'name' => 'Zuza Administrator',
            'email' => 'admin@vet.pl',
            'password' => Hash::make('TajneJezoweHaslo333'), 
            'role_id' => $adminRole->id,
        ]);

        $doctors = User::factory(3)->create([
            'role_id' => $doctorRole->id
        ]);

        User::factory(10)->create(['role_id' => $clientRole->id])->each(function ($client) use ($doctors, $services) {
            
            $pets = Pet::factory(rand(1, 2))->create([
                'user_id' => $client->id
            ]);

            foreach ($pets as $pet) {
                Appointment::factory()->create([
                    'client_id' => $client->id,
                    'doctor_id' => $doctors->random()->id,
                    'pet_id' => $pet->id,
                    'service_id' => $services->random()->id,
                    'status' => 'oczekująca',
                ]);
            }
        });
    }
}