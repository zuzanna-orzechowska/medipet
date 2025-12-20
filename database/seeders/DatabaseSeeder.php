<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //role
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'lekarz']);
        $clientRole = Role::create(['name' => 'klient']);

        //usługi
        $services = Service::factory(5)->create();

        //administrator
        User::factory()->create([
            'name' => 'Zuza Administrator',
            'email' => 'admin@vet.pl',
            'password' => bcrypt('TajneJezoweHaslo333'),
            'role_id' => $adminRole->id,
        ]);

        //lekarze
        $doctors = User::factory(3)->doctor()->create();

        //klienci i ich zwierzęta
        User::factory(10)->create()->each(function ($client) use ($doctors, $services) {
            $pets = Pet::factory(rand(1, 2))->create([
                'user_id' => $client->id
            ]);

            foreach ($pets as $pet) {
                Appointment::factory()->create([
                    'client_id' => $client->id,
                    'doctor_id' => $doctors->random()->id,
                    'pet_id' => $pet->id,
                    'service_id' => $services->random()->id,
                ]);
            }
        });
    }
}