<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    private static $services = [
        ['name' => 'Konsultacja weterynaryjna', 'price' => 120, 'duration' => 30],
        ['name' => 'Szczepienie kompleksowe', 'price' => 150, 'duration' => 15],
        ['name' => 'Badanie krwi (profil rozszerzony)', 'price' => 200, 'duration' => 30],
        ['name' => 'USG jamy brzusznej', 'price' => 180, 'duration' => 45],
        ['name' => 'Kastracja / Sterylizacja', 'price' => 450, 'duration' => 90],
    ];

    private static $index = 0;

    public function definition(): array
    {
        $service = self::$services[self::$index % count(self::$services)];
        self::$index++;

        return [
            'name' => $service['name'],
            'description' => 'Profesjonalna usługa ' . strtolower($service['name']) . ' wykonywana przez naszych specjalistów.',
            'price' => $service['price'],
            'duration_minutes' => $service['duration'],
        ];
    }
}