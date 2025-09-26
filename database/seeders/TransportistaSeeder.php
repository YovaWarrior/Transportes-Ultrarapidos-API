<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportista;

class TransportistaSeeder extends Seeder
{
    public function run()
    {
        $transportistas = [
            // Empresas grandes
            [
                'nombre' => 'Transportes Guatemala S.A.',
                'tipo' => 'empresa',
                'nit' => '12345678-9',
                'telefono' => '2234-5678',
                'direccion' => 'Zona 10, Ciudad de Guatemala',
                'email' => 'info@transportesgt.com',
                'active' => true
            ],
            [
                'nombre' => 'Logística Maya',
                'tipo' => 'empresa',
                'nit' => '98765432-1',
                'telefono' => '2345-6789',
                'direccion' => 'Zona 9, Ciudad de Guatemala',
                'email' => 'contacto@maya.com',
                'active' => true
            ],
            [
                'nombre' => 'Transportes del Norte',
                'tipo' => 'empresa',
                'nit' => '11111111-1',
                'telefono' => '2111-1111',
                'direccion' => 'Zona 1, Ciudad de Guatemala',
                'email' => 'norte@transporte.com',
                'active' => true
            ],
            [
                'nombre' => 'Cargo Express Centroamérica',
                'tipo' => 'empresa',
                'nit' => '55555555-5',
                'telefono' => '2555-5555',
                'direccion' => 'Zona 4, Ciudad de Guatemala',
                'email' => 'info@cargoexpress.com',
                'active' => true
            ],
            [
                'nombre' => 'Transportes Quetzal',
                'tipo' => 'empresa',
                'nit' => '33333333-3',
                'telefono' => '2333-3333',
                'direccion' => 'Zona 7, Ciudad de Guatemala',
                'email' => 'gerencia@quetzal.com',
                'active' => true
            ],
            [
                'nombre' => 'Flota Pesada Guatemala',
                'tipo' => 'empresa',
                'nit' => '77777777-7',
                'telefono' => '2777-7777',
                'direccion' => 'Zona 11, Ciudad de Guatemala',
                'email' => 'ventas@flotapesada.com',
                'active' => true
            ],
            [
                'nombre' => 'Transportes Volcán',
                'tipo' => 'empresa',
                'nit' => '88888888-8',
                'telefono' => '2888-8888',
                'direccion' => 'Escuintla, Guatemala',
                'email' => 'admin@volcan.com',
                'active' => true
            ],

            // Transportistas independientes
            [
                'nombre' => 'Carlos Pérez',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-1234',
                'direccion' => 'Mixco, Guatemala',
                'email' => 'carlos@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'María González',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-5678',
                'direccion' => 'Villa Nueva, Guatemala',
                'email' => 'maria@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Roberto Morales',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-9876',
                'direccion' => 'Amatitlán, Guatemala',
                'email' => 'roberto.morales@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Ana Patricia López',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-4321',
                'direccion' => 'San José Pinula, Guatemala',
                'email' => 'ana.lopez@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Luis Fernando Castillo',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-8765',
                'direccion' => 'Chinautla, Guatemala',
                'email' => 'luis.castillo@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Sandra Flores',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-2468',
                'direccion' => 'Fraijanes, Guatemala',
                'email' => 'sandra.flores@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Diego Méndez',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-1357',
                'direccion' => 'Villa Canales, Guatemala',
                'email' => 'diego.mendez@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Rosa Hernández',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-9753',
                'direccion' => 'Santa Catarina Pinula, Guatemala',
                'email' => 'rosa.hernandez@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Jorge Ramírez',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-8642',
                'direccion' => 'San Miguel Petapa, Guatemala',
                'email' => 'jorge.ramirez@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Carmen Vásquez',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-7531',
                'direccion' => 'Palencia, Guatemala',
                'email' => 'carmen.vasquez@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Mario Rodríguez',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-9864',
                'direccion' => 'San Pedro Ayampuc, Guatemala',
                'email' => 'mario.rodriguez@gmail.com',
                'active' => true
            ],
            [
                'nombre' => 'Patricia Juárez',
                'tipo' => 'independiente',
                'nit' => null,
                'telefono' => '5555-1975',
                'direccion' => 'San Pedro Sacatepéquez, Guatemala',
                'email' => 'patricia.juarez@gmail.com',
                'active' => true
            ]
        ];

        foreach ($transportistas as $transportista) {
            Transportista::create($transportista);
        }
    }
}
