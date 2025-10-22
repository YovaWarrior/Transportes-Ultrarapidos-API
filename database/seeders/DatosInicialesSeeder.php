<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportista;
use App\Models\Camion;

class DatosInicialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear transportistas
        $transportista1 = Transportista::create([
            'nombre' => 'Transportes Guatemala S.A.',
            'tipo' => 'empresa',
            'nit' => '12345678-9',
            'telefono' => '2234-5678',
            'email' => 'info@transportesgt.com',
            'direccion' => 'Zona 10, Ciudad de Guatemala',
            'active' => true
        ]);

        $transportista2 = Transportista::create([
            'nombre' => 'Logística Maya',
            'tipo' => 'empresa',
            'nit' => '98765432-1',
            'telefono' => '2345-6789',
            'email' => 'contacto@logisticamaya.com',
            'direccion' => 'Zona 12, Ciudad de Guatemala',
            'active' => true
        ]);

        $transportista3 = Transportista::create([
            'nombre' => 'Juan Pérez',
            'tipo' => 'independiente',
            'telefono' => '5555-1234',
            'email' => 'juan.perez@gmail.com',
            'direccion' => 'Zona 18, Guatemala',
            'active' => true
        ]);

        // Crear camiones para transportista 1
        Camion::create([
            'placa' => 'P-001AAA',
            'marca' => 'Volvo',
            'modelo' => 'FH16',
            'año' => 2020,
            'tipo' => 'plataforma',
            'capacidad' => 40,
            'estado' => 'activo',
            'transportista_id' => $transportista1->id
        ]);

        Camion::create([
            'placa' => 'C-002BBB',
            'marca' => 'Mercedes',
            'modelo' => 'Actros',
            'año' => 2021,
            'tipo' => 'furgón',
            'capacidad' => 35,
            'estado' => 'activo',
            'transportista_id' => $transportista1->id
        ]);

        Camion::create([
            'placa' => 'TC-003CCC',
            'marca' => 'Scania',
            'modelo' => 'R450',
            'año' => 2019,
            'tipo' => 'refrigerado',
            'capacidad' => 30,
            'estado' => 'mantenimiento',
            'transportista_id' => $transportista1->id
        ]);

        // Crear camiones para transportista 2
        Camion::create([
            'placa' => 'P-004DDD',
            'marca' => 'Freightliner',
            'modelo' => 'Cascadia',
            'año' => 2022,
            'tipo' => 'plataforma',
            'capacidad' => 45,
            'estado' => 'activo',
            'transportista_id' => $transportista2->id
        ]);

        Camion::create([
            'placa' => 'C-005EEE',
            'marca' => 'Kenworth',
            'modelo' => 'T680',
            'año' => 2020,
            'tipo' => 'carga_general',
            'capacidad' => 38,
            'estado' => 'activo',
            'transportista_id' => $transportista2->id
        ]);

        Camion::create([
            'placa' => 'P-006FFF',
            'marca' => 'Mack',
            'modelo' => 'Anthem',
            'año' => 2018,
            'tipo' => 'tanque',
            'capacidad' => 32,
            'estado' => 'fuera_servicio',
            'transportista_id' => $transportista2->id
        ]);

        // Crear camiones para transportista 3
        Camion::create([
            'placa' => 'P-007GGG',
            'marca' => 'Volvo',
            'modelo' => 'FM',
            'año' => 2021,
            'tipo' => 'furgón',
            'capacidad' => 28,
            'estado' => 'activo',
            'transportista_id' => $transportista3->id
        ]);

        $this->command->info('✅ Datos iniciales creados exitosamente!');
        $this->command->info('📊 3 Transportistas y 7 Camiones registrados.');
    }
}
