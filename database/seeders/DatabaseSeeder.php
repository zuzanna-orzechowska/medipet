<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'lekarz']);
        $clientRole = Role::create(['name' => 'klient']);
        $services = Service::factory(5)->create();

        //administrator
        User::factory()->create([
            'name' => 'Zuza Administrator',
            'email' => 'admin@vet.pl',
            'password' => Hash::make('TajneJezoweHaslo333'), 
            'role_id' => $adminRole->id,
        ]);

        //doktorzy
        $doctors = new Collection();
        
        $doctors->push(User::factory()->create([
            'name' => 'Anna Nowak',
            'email' => 'anna.nowak@vet.pl',
            'password' => Hash::make('Lekarz666'),
            'role_id' => $doctorRole->id,
        ]));

        $randomDoctors = User::factory(2)->create([
            'role_id' => $doctorRole->id
        ]);

        $doctors = $doctors->concat($randomDoctors);

        //klienci
        $fixedClient = User::factory()->create([
            'name' => 'Jacek Kopec',
            'email' => 'jacek.kopec@poczta.pl',
            'password' => Hash::make('Klient111'),
            'role_id' => $clientRole->id,
        ]);

        $randomClients = User::factory(9)->create([
            'role_id' => $clientRole->id
        ]);

        $allClients = collect([$fixedClient])->concat($randomClients);

        $allClients->each(function ($client) use ($doctors, $services) {
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