<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bodega;

class BodegaSeeder extends Seeder
{
    public function run()
    {
        $bodegas = [
            // Bodegas para Predio Central Guatemala (ID: 1)
            [
                'predio_id' => 1,
                'nombre' => 'Bodega A - Mercancía General',
                'descripcion' => 'Bodega principal para mercancía general y productos manufacturados',
                'active' => true
            ],
            [
                'predio_id' => 1,
                'nombre' => 'Bodega B - Productos Refrigerados',
                'descripcion' => 'Bodega con sistema de refrigeración para productos perecederos',
                'active' => true
            ],

            // Bodegas para Predio Norte Guatemala (ID: 2)
            [
                'predio_id' => 2,
                'nombre' => 'Bodega Norte 1',
                'descripcion' => 'Bodega de distribución para zona norte',
                'active' => true
            ],
            [
                'predio_id' => 2,
                'nombre' => 'Bodega Norte 2',
                'descripcion' => 'Bodega secundaria zona norte',
                'active' => true
            ],

            // Bodegas para Predio San Salvador Central (ID: 3)
            [
                'predio_id' => 3,
                'nombre' => 'Bodega SV Central',
                'descripcion' => 'Bodega principal El Salvador',
                'active' => true
            ],
            [
                'predio_id' => 3,
                'nombre' => 'Bodega SV Exportación',
                'descripcion' => 'Bodega especializada en mercancía de exportación',
                'active' => true
            ],

            // Bodegas para Predio Santa Ana (ID: 4)
            [
                'predio_id' => 4,
                'nombre' => 'Bodega Santa Ana',
                'descripcion' => 'Bodega regional Santa Ana',
                'active' => true
            ]
        ];

        foreach ($bodegas as $bodega) {
            Bodega::create($bodega);
        }
    }
}
