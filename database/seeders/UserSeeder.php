<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrador del sistema
        User::create([
            'name' => 'Administrador Sistema',
            'email' => 'admin@transportes.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'active' => true,
        ]);

        // Usuario operativo (control de predios, logística)
        User::create([
            'name' => 'Usuario Operativo',
            'email' => 'operativo@transportes.com',
            'password' => Hash::make('operativo123'),
            'role' => 'operativo',
            'active' => true,
        ]);

        // Piloto
        User::create([
            'name' => 'Piloto de Prueba',
            'email' => 'piloto@transportes.com',
            'password' => Hash::make('piloto123'),
            'role' => 'piloto',
            'active' => true,
        ]);

        // Usuarios adicionales
        User::create([
            'name' => 'Carlos López',
            'email' => 'carlos.lopez@transportes.com',
            'password' => Hash::make('password123'),
            'role' => 'operativo',
            'active' => true,
        ]);

        User::create([
            'name' => 'María González',
            'email' => 'maria.gonzalez@transportes.com',
            'password' => Hash::make('password123'),
            'role' => 'operativo',
            'active' => true,
        ]);
    }
}
