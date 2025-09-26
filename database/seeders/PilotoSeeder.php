<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Piloto;

class PilotoSeeder extends Seeder
{
    public function run()
    {
        $pilotos = [
            // Pilotos de Transportes Guatemala S.A. (transportista_id: 1) - 12 pilotos
            [
                'transportista_id' => 1,
                'nombre' => 'José Roberto Morales',
                'licencia' => 'LIC-GT-001234',
                'telefono' => '5555-1111',
                'dpi' => '1234567890101',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Ana Patricia López',
                'licencia' => 'LIC-GT-001235',
                'telefono' => '5555-2222',
                'dpi' => '1234567890102',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Marco Antonio Ruiz',
                'licencia' => 'LIC-GT-001236',
                'telefono' => '5555-3333',
                'dpi' => '1234567890103',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Carmen Elena Vásquez',
                'licencia' => 'LIC-GT-001237',
                'telefono' => '5555-1122',
                'dpi' => '1234567890104',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Eduardo Ramírez García',
                'licencia' => 'LIC-GT-001238',
                'telefono' => '5555-3344',
                'dpi' => '1234567890105',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Silvia Morales Jiménez',
                'licencia' => 'LIC-GT-001239',
                'telefono' => '5555-5566',
                'dpi' => '1234567890106',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Fernando Castro López',
                'licencia' => 'LIC-GT-001240',
                'telefono' => '5555-7788',
                'dpi' => '1234567890107',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Gabriela Hernández Ruiz',
                'licencia' => 'LIC-GT-001241',
                'telefono' => '5555-9900',
                'dpi' => '1234567890108',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Miguel Ángel Pérez',
                'licencia' => 'LIC-GT-001242',
                'telefono' => '5555-2244',
                'dpi' => '1234567890109',
                'active' => false
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Rosa María Sandoval',
                'licencia' => 'LIC-GT-001243',
                'telefono' => '5555-4466',
                'dpi' => '1234567890110',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Alejandro Mendoza Cruz',
                'licencia' => 'LIC-GT-001244',
                'telefono' => '5555-6688',
                'dpi' => '1234567890111',
                'active' => true
            ],
            [
                'transportista_id' => 1,
                'nombre' => 'Patricia González Flores',
                'licencia' => 'LIC-GT-001245',
                'telefono' => '5555-8800',
                'dpi' => '1234567890112',
                'active' => true
            ],

            // Pilotos de Logística Maya (transportista_id: 2) - 8 pilotos
            [
                'transportista_id' => 2,
                'nombre' => 'Luis Fernando Castillo',
                'licencia' => 'LIC-GT-002001',
                'telefono' => '5555-4444',
                'dpi' => '1234567890201',
                'active' => true
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'Rosa María Hernández',
                'licencia' => 'LIC-GT-002002',
                'telefono' => '5555-5555',
                'dpi' => '1234567890202',
                'active' => true
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'Carlos Eduardo Mejía',
                'licencia' => 'LIC-GT-002003',
                'telefono' => '5555-1357',
                'dpi' => '1234567890203',
                'active' => true
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'Sandra Elizabeth Morales',
                'licencia' => 'LIC-GT-002004',
                'telefono' => '5555-2468',
                'dpi' => '1234567890204',
                'active' => true
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'Roberto Carlos Vásquez',
                'licencia' => 'LIC-GT-002005',
                'telefono' => '5555-3579',
                'dpi' => '1234567890205',
                'active' => true
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'María José Rodríguez',
                'licencia' => 'LIC-GT-002006',
                'telefono' => '5555-4680',
                'dpi' => '1234567890206',
                'active' => false
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'Jorge Alberto Ramírez',
                'licencia' => 'LIC-GT-002007',
                'telefono' => '5555-5791',
                'dpi' => '1234567890207',
                'active' => true
            ],
            [
                'transportista_id' => 2,
                'nombre' => 'Diana Carolina López',
                'licencia' => 'LIC-GT-002008',
                'telefono' => '5555-6802',
                'dpi' => '1234567890208',
                'active' => true
            ],

            // Pilotos de Transportes del Norte (transportista_id: 3) - 10 pilotos
            [
                'transportista_id' => 3,
                'nombre' => 'Diego Alejandro Méndez',
                'licencia' => 'LIC-GT-003001',
                'telefono' => '5555-6666',
                'dpi' => '1234567890301',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Sandra Elizabeth Flores',
                'licencia' => 'LIC-GT-003002',
                'telefono' => '5555-7777',
                'dpi' => '1234567890302',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Manuel Antonio García',
                'licencia' => 'LIC-GT-003003',
                'telefono' => '5555-8888',
                'dpi' => '1234567890303',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Lucía Mercedes Castillo',
                'licencia' => 'LIC-GT-003004',
                'telefono' => '5555-9999',
                'dpi' => '1234567890304',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Raúl Enrique Moreno',
                'licencia' => 'LIC-GT-003005',
                'telefono' => '5555-1010',
                'dpi' => '1234567890305',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Verónica Isabel Juárez',
                'licencia' => 'LIC-GT-003006',
                'telefono' => '5555-2020',
                'dpi' => '1234567890306',
                'active' => false
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Héctor David Romero',
                'licencia' => 'LIC-GT-003007',
                'telefono' => '5555-3030',
                'dpi' => '1234567890307',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Claudia Beatriz Herrera',
                'licencia' => 'LIC-GT-003008',
                'telefono' => '5555-4040',
                'dpi' => '1234567890308',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Oscar Javier Sánchez',
                'licencia' => 'LIC-GT-003009',
                'telefono' => '5555-5050',
                'dpi' => '1234567890309',
                'active' => true
            ],
            [
                'transportista_id' => 3,
                'nombre' => 'Andrea Sofía Martínez',
                'licencia' => 'LIC-GT-003010',
                'telefono' => '5555-6060',
                'dpi' => '1234567890310',
                'active' => true
            ],

            // Pilotos de Cargo Express Centroamérica (transportista_id: 4) - 6 pilotos
            [
                'transportista_id' => 4,
                'nombre' => 'Ricardo Alejandro Fuentes',
                'licencia' => 'LIC-GT-004001',
                'telefono' => '5555-7070',
                'dpi' => '1234567890401',
                'active' => true
            ],
            [
                'transportista_id' => 4,
                'nombre' => 'Mónica Patricia Escobar',
                'licencia' => 'LIC-GT-004002',
                'telefono' => '5555-8080',
                'dpi' => '1234567890402',
                'active' => true
            ],
            [
                'transportista_id' => 4,
                'nombre' => 'Sergio Daniel Aguilar',
                'licencia' => 'LIC-GT-004003',
                'telefono' => '5555-9090',
                'dpi' => '1234567890403',
                'active' => true
            ],
            [
                'transportista_id' => 4,
                'nombre' => 'Carolina Michelle Torres',
                'licencia' => 'LIC-GT-004004',
                'telefono' => '5555-1212',
                'dpi' => '1234567890404',
                'active' => true
            ],
            [
                'transportista_id' => 4,
                'nombre' => 'Arturo Emilio Guzmán',
                'licencia' => 'LIC-GT-004005',
                'telefono' => '5555-2323',
                'dpi' => '1234567890405',
                'active' => false
            ],
            [
                'transportista_id' => 4,
                'nombre' => 'Paola Vanessa Delgado',
                'licencia' => 'LIC-GT-004006',
                'telefono' => '5555-3434',
                'dpi' => '1234567890406',
                'active' => true
            ],

            // Pilotos de Transportes Quetzal (transportista_id: 5) - 5 pilotos
            [
                'transportista_id' => 5,
                'nombre' => 'Javier Antonio Morales',
                'licencia' => 'LIC-GT-005001',
                'telefono' => '5555-4545',
                'dpi' => '1234567890501',
                'active' => true
            ],
            [
                'transportista_id' => 5,
                'nombre' => 'Susana Elizabeth Vargas',
                'licencia' => 'LIC-GT-005002',
                'telefono' => '5555-5656',
                'dpi' => '1234567890502',
                'active' => true
            ],
            [
                'transportista_id' => 5,
                'nombre' => 'Rolando César Medina',
                'licencia' => 'LIC-GT-005003',
                'telefono' => '5555-6767',
                'dpi' => '1234567890503',
                'active' => true
            ],
            [
                'transportista_id' => 5,
                'nombre' => 'Karla Judith Peña',
                'licencia' => 'LIC-GT-005004',
                'telefono' => '5555-7878',
                'dpi' => '1234567890504',
                'active' => true
            ],
            [
                'transportista_id' => 5,
                'nombre' => 'Giovanni Enrique Solís',
                'licencia' => 'LIC-GT-005005',
                'telefono' => '5555-8989',
                'dpi' => '1234567890505',
                'active' => false
            ],

            // Pilotos de Flota Pesada Guatemala (transportista_id: 6) - 8 pilotos
            [
                'transportista_id' => 6,
                'nombre' => 'Leonardo Gabriel Rojas',
                'licencia' => 'LIC-GT-006001',
                'telefono' => '5555-9191',
                'dpi' => '1234567890601',
                'active' => true
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Alejandra Cristina Navarro',
                'licencia' => 'LIC-GT-006002',
                'telefono' => '5555-1313',
                'dpi' => '1234567890602',
                'active' => true
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Mauricio José Campos',
                'licencia' => 'LIC-GT-006003',
                'telefono' => '5555-2424',
                'dpi' => '1234567890603',
                'active' => true
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Stephanie Nicole Ramos',
                'licencia' => 'LIC-GT-006004',
                'telefono' => '5555-3535',
                'dpi' => '1234567890604',
                'active' => true
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Rodrigo Alexander Silva',
                'licencia' => 'LIC-GT-006005',
                'telefono' => '5555-4646',
                'dpi' => '1234567890605',
                'active' => true
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Kimberly Paola Estrada',
                'licencia' => 'LIC-GT-006006',
                'telefono' => '5555-5757',
                'dpi' => '1234567890606',
                'active' => true
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Bruno Rafael Córdoba',
                'licencia' => 'LIC-GT-006007',
                'telefono' => '5555-6868',
                'dpi' => '1234567890607',
                'active' => false
            ],
            [
                'transportista_id' => 6,
                'nombre' => 'Valeria Sofía Montenegro',
                'licencia' => 'LIC-GT-006008',
                'telefono' => '5555-7979',
                'dpi' => '1234567890608',
                'active' => true
            ],

            // Pilotos de Transportes Volcán (transportista_id: 7) - 4 pilotos
            [
                'transportista_id' => 7,
                'nombre' => 'Óscar Emilio Quintana',
                'licencia' => 'LIC-GT-007001',
                'telefono' => '5555-8181',
                'dpi' => '1234567890701',
                'active' => true
            ],
            [
                'transportista_id' => 7,
                'nombre' => 'Melissa Andrea Cortés',
                'licencia' => 'LIC-GT-007002',
                'telefono' => '5555-9292',
                'dpi' => '1234567890702',
                'active' => true
            ],
            [
                'transportista_id' => 7,
                'nombre' => 'Félix Armando Pacheco',
                'licencia' => 'LIC-GT-007003',
                'telefono' => '5555-1414',
                'dpi' => '1234567890703',
                'active' => true
            ],
            [
                'transportista_id' => 7,
                'nombre' => 'Roxana Beatriz Alvarado',
                'licencia' => 'LIC-GT-007004',
                'telefono' => '5555-2525',
                'dpi' => '1234567890704',
                'active' => true
            ],

            // Transportistas independientes - cada uno es su propio piloto (transportista_id: 8-19)
            [
                'transportista_id' => 8,
                'nombre' => 'Carlos Pérez',
                'licencia' => 'LIC-GT-008001',
                'telefono' => '5555-1234',
                'dpi' => '1234567890801',
                'active' => true
            ],
            [
                'transportista_id' => 9,
                'nombre' => 'María González',
                'licencia' => 'LIC-GT-009001',
                'telefono' => '5555-5678',
                'dpi' => '1234567890901',
                'active' => true
            ],
            [
                'transportista_id' => 10,
                'nombre' => 'Roberto Morales',
                'licencia' => 'LIC-GT-010001',
                'telefono' => '5555-9876',
                'dpi' => '1234567891001',
                'active' => true
            ],
            [
                'transportista_id' => 11,
                'nombre' => 'Ana Patricia López',
                'licencia' => 'LIC-GT-011001',
                'telefono' => '5555-4321',
                'dpi' => '1234567891101',
                'active' => true
            ],
            [
                'transportista_id' => 12,
                'nombre' => 'Luis Fernando Castillo',
                'licencia' => 'LIC-GT-012001',
                'telefono' => '5555-8765',
                'dpi' => '1234567891201',
                'active' => true
            ],
            [
                'transportista_id' => 13,
                'nombre' => 'Sandra Flores',
                'licencia' => 'LIC-GT-013001',
                'telefono' => '5555-2468',
                'dpi' => '1234567891301',
                'active' => true
            ],
            [
                'transportista_id' => 14,
                'nombre' => 'Diego Méndez',
                'licencia' => 'LIC-GT-014001',
                'telefono' => '5555-1357',
                'dpi' => '1234567891401',
                'active' => true
            ],
            [
                'transportista_id' => 15,
                'nombre' => 'Rosa Hernández',
                'licencia' => 'LIC-GT-015001',
                'telefono' => '5555-9753',
                'dpi' => '1234567891501',
                'active' => true
            ],
            [
                'transportista_id' => 16,
                'nombre' => 'Jorge Ramírez',
                'licencia' => 'LIC-GT-016001',
                'telefono' => '5555-8642',
                'dpi' => '1234567891601',
                'active' => true
            ],
            [
                'transportista_id' => 17,
                'nombre' => 'Carmen Vásquez',
                'licencia' => 'LIC-GT-017001',
                'telefono' => '5555-7531',
                'dpi' => '1234567891701',
                'active' => true
            ],
            [
                'transportista_id' => 18,
                'nombre' => 'Mario Rodríguez',
                'licencia' => 'LIC-GT-018001',
                'telefono' => '5555-9864',
                'dpi' => '1234567891801',
                'active' => true
            ],
            [
                'transportista_id' => 19,
                'nombre' => 'Patricia Juárez',
                'licencia' => 'LIC-GT-019001',
                'telefono' => '5555-1975',
                'dpi' => '1234567891901',
                'active' => true
            ]
        ];

        foreach ($pilotos as $piloto) {
            Piloto::create($piloto);
        }
    }
}
