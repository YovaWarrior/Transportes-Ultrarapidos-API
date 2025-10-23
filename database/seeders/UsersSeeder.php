<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@transportes.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'active' => true,
            ]
        );

        // Operativo
        User::updateOrCreate(
            ['email' => 'operativo@transportes.com'],
            [
                'name' => 'Operativo',
                'password' => Hash::make('operativo123'),
                'role' => 'operativo',
                'active' => true,
            ]
        );

        // Piloto
        User::updateOrCreate(
            ['email' => 'piloto@transportes.com'],
            [
                'name' => 'Piloto',
                'password' => Hash::make('piloto123'),
                'role' => 'piloto',
                'active' => true,
            ]
        );

        $this->command->info('✅ Usuarios de prueba creados/actualizados.');
        $this->command->info('   - admin@transportes.com / admin123');
        $this->command->info('   - operativo@transportes.com / operativo123');
        $this->command->info('   - piloto@transportes.com / piloto123');
    }
}
