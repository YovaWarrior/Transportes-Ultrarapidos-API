<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportista;

class TransportistaSeeder extends Seeder
{
    public function run()
    {
        $transportistas = [
            ['nombre' => 'Transportes Guatemala S.A.', 'tipo' => 'empresa', 'nit' => '12345678-9', 'telefono' => '2234-5678', 'direccion' => 'Zona 10, Guatemala', 'email' => 'info@transportesgt.com'],
            ['nombre' => 'Logística Maya', 'tipo' => 'empresa', 'nit' => '98765432-1', 'telefono' => '2345-6789', 'direccion' => 'Zona 9, Guatemala', 'email' => 'contacto@maya.com'],
            ['nombre' => 'Carlos Pérez', 'tipo' => 'independiente', 'nit' => null, 'telefono' => '5555-1234', 'direccion' => 'Mixco', 'email' => 'carlos@gmail.com'],
            ['nombre' => 'María González', 'tipo' => 'independiente', 'nit' => null, 'telefono' => '5555-5678', 'direccion' => 'Villa Nueva', 'email' => 'maria@gmail.com'],
            ['nombre' => 'Transportes del Norte', 'tipo' => 'empresa', 'nit' => '11111111-1', 'telefono' => '2111-1111', 'direccion' => 'Zona 1, Guatemala', 'email' => 'norte@transporte.com'],
        ];

        foreach ($transportistas as $transportista) {
            Transportista::create($transportista);
        }
    }
}
