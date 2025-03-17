<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Owner;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\Reading;
use App\Models\QRPlate;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
       
        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //Razas
       $breeds = Breed::factory()->createMany([
            ['breedName' => 'Pitbull', 'size' => 'Grande'],
            ['breedName' => 'Chihuahua', 'size' => 'Pequeño'],
            ['breedName' => 'Labrador', 'size' => 'Mediano'],
            ['breedName' => 'Pastor Alemán', 'size' => 'Grande'],
            ['breedName' => 'Bulldog', 'size' => 'Mediano'],
        ]);
      // Crear 10 propietarios, cada uno con 3 mascotas
      Owner::factory(10)->create()->each(function ($owner) use ($breeds) {
        // Cada propietario tendrá 3 mascotas
        Pet::factory(3)->create([
            'owner_id' => $owner->id,
            'breed_id' => $breeds->random()->id, // Asigna una raza aleatoria
        ])->each(function ($pet) {
            // Cada mascota tendrá una placa QR
            QRPlate::factory()->create([
                'pet_id' => $pet->id,
            ])->each(function ($qrPlate) {
                // Cada placa QR tendrá una lectura
                Reading::factory()->create([
                    'QRPlate_id' => $qrPlate->id,
                ]);
            });
        });
    });
       
    }
    
}
