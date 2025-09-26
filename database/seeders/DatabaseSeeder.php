<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador por defecto
        User::factory()->create([
            'name' => 'Administrador Sistema',
            'email' => 'admin@transportes.com',
            'password' => bcrypt('admin123')
        ]);

        // Crear usuario operativo
        User::factory()->create([
            'name' => 'Operador Guatemala',
            'email' => 'operador@transportes.com',
            'password' => bcrypt('operador123')
        ]);

        // Ejecutar seeders en orden correcto por dependencias
        $this->call([
            TransportistaSeeder::class,
            PredioSeeder::class,
            BodegaSeeder::class,
            CamionSeeder::class,
            PilotoSeeder::class,
            OrdenTrabajoSeeder::class,
        ]);
    }
}
