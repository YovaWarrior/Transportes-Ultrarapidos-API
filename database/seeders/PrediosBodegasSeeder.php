<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Predio;
use App\Models\Bodega;

class PrediosBodegasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // GUATEMALA - 2 Predios
        $predioGT1 = Predio::create([
            'nombre' => 'Predio Central Guatemala',
            'pais' => 'Guatemala',
            'direccion' => 'Zona 12, Ciudad de Guatemala',
            'telefono' => '+502 2345-6789',
            'active' => true,
        ]);

        Bodega::create([
            'predio_id' => $predioGT1->id,
            'nombre' => 'Bodega A - Productos Secos',
            'descripcion' => 'Almacenamiento de productos no perecederos',
            'active' => true,
        ]);

        Bodega::create([
            'predio_id' => $predioGT1->id,
            'nombre' => 'Bodega B - Refrigerados',
            'descripcion' => 'Almacenamiento con refrigeración',
            'active' => true,
        ]);

        $predioGT2 = Predio::create([
            'nombre' => 'Predio Norte Guatemala',
            'pais' => 'Guatemala',
            'direccion' => 'Zona 18, Ciudad de Guatemala',
            'telefono' => '+502 2345-6790',
            'active' => true,
        ]);

        Bodega::create([
            'predio_id' => $predioGT2->id,
            'nombre' => 'Bodega Principal',
            'descripcion' => 'Bodega de distribución general',
            'active' => true,
        ]);

        // EL SALVADOR - 2 Predios
        $predioSV1 = Predio::create([
            'nombre' => 'Predio San Salvador',
            'pais' => 'El Salvador',
            'direccion' => 'Boulevard del Ejército, San Salvador',
            'telefono' => '+503 2234-5678',
            'active' => true,
        ]);

        Bodega::create([
            'predio_id' => $predioSV1->id,
            'nombre' => 'Bodega Central SV',
            'descripcion' => 'Almacén principal El Salvador',
            'active' => true,
        ]);

        Bodega::create([
            'predio_id' => $predioSV1->id,
            'nombre' => 'Bodega Secundaria SV',
            'descripcion' => 'Almacén de respaldo',
            'active' => true,
        ]);

        $predioSV2 = Predio::create([
            'nombre' => 'Predio Santa Ana',
            'pais' => 'El Salvador',
            'direccion' => 'Carretera Panamericana, Santa Ana',
            'telefono' => '+503 2234-5679',
            'active' => true,
        ]);

        Bodega::create([
            'predio_id' => $predioSV2->id,
            'nombre' => 'Bodega Santa Ana',
            'descripcion' => 'Distribución regional occidente',
            'active' => true,
        ]);
    }
}
