<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Predio;

class PredioSeeder extends Seeder
{
    public function run()
    {
        $predios = [
            [
                'nombre' => 'Predio Central Guatemala',
                'pais' => 'Guatemala',
                'direccion' => 'Zona 12, Ciudad de Guatemala',
                'telefono' => '2234-5678',
                'active' => true
            ],
            [
                'nombre' => 'Predio Norte Guatemala',
                'pais' => 'Guatemala',
                'direccion' => 'Zona 18, Ciudad de Guatemala',
                'telefono' => '2234-9999',
                'active' => true
            ],
            [
                'nombre' => 'Predio San Salvador Central',
                'pais' => 'El Salvador',
                'direccion' => 'Colonia Escalón, San Salvador',
                'telefono' => '2503-1234',
                'active' => true
            ],
            [
                'nombre' => 'Predio Santa Ana',
                'pais' => 'El Salvador',
                'direccion' => 'Centro de Santa Ana',
                'telefono' => '2441-5678',
                'active' => true
            ]
        ];

        foreach ($predios as $predio) {
            Predio::create($predio);
        }
    }
}
