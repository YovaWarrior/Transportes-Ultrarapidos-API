<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdenTrabajo;
use Carbon\Carbon;

class OrdenTrabajoSeeder extends Seeder
{
    public function run()
    {
        $ordenes = [
            // Órdenes completadas de la semana pasada
            [
                'numero_orden' => 'OT-2025-0001',
                'camion_id' => 1, // P-001AAA
                'piloto_id' => 1, // José Roberto Morales
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 1, // Bodega A
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(6)
            ],
            [
                'numero_orden' => 'OT-2025-0002',
                'camion_id' => 2, // P-002BBB
                'piloto_id' => 2, // Ana Patricia López
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 2, // Bodega B
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'numero_orden' => 'OT-2025-0003',
                'camion_id' => 9, // M-100XYZ
                'piloto_id' => 13, // Luis Fernando Castillo
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 3, // Bodega Norte 1
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'numero_orden' => 'OT-2025-0004',
                'camion_id' => 15, // TN-400JKL
                'piloto_id' => 21, // Diego Alejandro Méndez
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 5, // Bodega SV Central
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(4)
            ],
            [
                'numero_orden' => 'OT-2025-0005',
                'camion_id' => 40, // C-500DEF
                'piloto_id' => 53, // Carlos Pérez
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 1, // Bodega A
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(4)
            ],

            // Órdenes de esta semana
            [
                'numero_orden' => 'OT-2025-0006',
                'camion_id' => 4, // P-004DDD
                'piloto_id' => 4, // Carmen Elena Vásquez
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 4, // Bodega Norte 2
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'numero_orden' => 'OT-2025-0007',
                'camion_id' => 10, // M-101ABC
                'piloto_id' => 14, // Rosa María Hernández
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 6, // Bodega SV Exportación
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'numero_orden' => 'OT-2025-0008',
                'camion_id' => 19, // CE-200ABC
                'piloto_id' => 28, // Ricardo Alejandro Fuentes
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 2, // Bodega B
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'numero_orden' => 'OT-2025-0009',
                'camion_id' => 25, // Q-300PQR
                'piloto_id' => 34, // Javier Antonio Morales
                'predio_id' => 4, // Predio Santa Ana
                'bodega_id' => 7, // Bodega Santa Ana
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'numero_orden' => 'OT-2025-0010',
                'camion_id' => 29, // FP-500BCD
                'piloto_id' => 40, // Leonardo Gabriel Rojas
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 1, // Bodega A
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2)
            ],

            // Órdenes en proceso actualmente
            [
                'numero_orden' => 'OT-2025-0011',
                'camion_id' => 5, // P-005EEE
                'piloto_id' => 5, // Eduardo Ramírez García
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 3, // Bodega Norte 1
                'estado' => 'en_proceso',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subHours(12)
            ],
            [
                'numero_orden' => 'OT-2025-0012',
                'camion_id' => 11, // M-102DEF
                'piloto_id' => 15, // Carlos Eduardo Mejía
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 5, // Bodega SV Central
                'estado' => 'en_proceso',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subHours(8)
            ],
            [
                'numero_orden' => 'OT-2025-0013',
                'camion_id' => 16, // TN-401MNO
                'piloto_id' => 22, // Sandra Elizabeth Flores
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 2, // Bodega B
                'estado' => 'en_proceso',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subHours(6)
            ],
            [
                'numero_orden' => 'OT-2025-0014',
                'camion_id' => 20, // CE-201DEF
                'piloto_id' => 29, // Mónica Patricia Escobar
                'predio_id' => 4, // Predio Santa Ana
                'bodega_id' => 7, // Bodega Santa Ana
                'estado' => 'en_proceso',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subHours(4)
            ],
            [
                'numero_orden' => 'OT-2025-0015',
                'camion_id' => 31, // FP-501EFG
                'piloto_id' => 41, // Alejandra Cristina Navarro
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 4, // Bodega Norte 2
                'estado' => 'en_proceso',
                'created_at' => Carbon::now()->subHours(18),
                'updated_at' => Carbon::now()->subHours(2)
            ],

            // Órdenes pendientes de hoy
            [
                'numero_orden' => 'OT-2025-0016',
                'camion_id' => 6, // P-006FFF
                'piloto_id' => 6, // Silvia Morales Jiménez
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 1, // Bodega A
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(12),
                'updated_at' => Carbon::now()->subHours(12)
            ],
            [
                'numero_orden' => 'OT-2025-0017',
                'camion_id' => 12, // M-103GHI
                'piloto_id' => 16, // Sandra Elizabeth Morales
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 6, // Bodega SV Exportación
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(10),
                'updated_at' => Carbon::now()->subHours(10)
            ],
            [
                'numero_orden' => 'OT-2025-0018',
                'camion_id' => 17, // TN-402PQR
                'piloto_id' => 23, // Manuel Antonio García
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 3, // Bodega Norte 1
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(8),
                'updated_at' => Carbon::now()->subHours(8)
            ],
            [
                'numero_orden' => 'OT-2025-0019',
                'camion_id' => 21, // CE-202GHI
                'piloto_id' => 30, // Sergio Daniel Aguilar
                'predio_id' => 4, // Predio Santa Ana
                'bodega_id' => 7, // Bodega Santa Ana
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(6),
                'updated_at' => Carbon::now()->subHours(6)
            ],
            [
                'numero_orden' => 'OT-2025-0020',
                'camion_id' => 26, // Q-301STU
                'piloto_id' => 35, // Susana Elizabeth Vargas
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 2, // Bodega B
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(4),
                'updated_at' => Carbon::now()->subHours(4)
            ],
            [
                'numero_orden' => 'OT-2025-0021',
                'camion_id' => 33, // FP-503KLM
                'piloto_id' => 43, // Mauricio José Campos
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 4, // Bodega Norte 2
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(3)
            ],
            [
                'numero_orden' => 'OT-2025-0022',
                'camion_id' => 37, // V-600TUV
                'piloto_id' => 49, // Óscar Emilio Quintana
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 5, // Bodega SV Central
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2)
            ],
            [
                'numero_orden' => 'OT-2025-0023',
                'camion_id' => 41, // MG-200GHI
                'piloto_id' => 54, // María González
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 1, // Bodega A
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subHour(),
                'updated_at' => Carbon::now()->subHour()
            ],

            // Órdenes adicionales para tener más variedad
            [
                'numero_orden' => 'OT-2025-0024',
                'camion_id' => 7, // P-007GGG
                'piloto_id' => 7, // Fernando Castro López
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 6, // Bodega SV Exportación
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(7)
            ],
            [
                'numero_orden' => 'OT-2025-0025',
                'camion_id' => 13, // M-104JKL
                'piloto_id' => 17, // Roberto Carlos Vásquez
                'predio_id' => 4, // Predio Santa Ana
                'bodega_id' => 7, // Bodega Santa Ana
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(6)
            ],
            [
                'numero_orden' => 'OT-2025-0026',
                'camion_id' => 18, // TN-403STU
                'piloto_id' => 24, // Lucía Mercedes Castillo
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 2, // Bodega B
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'numero_orden' => 'OT-2025-0027',
                'camion_id' => 22, // CE-203JKL
                'piloto_id' => 31, // Carolina Michelle Torres
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 3, // Bodega Norte 1
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(4)
            ],
            [
                'numero_orden' => 'OT-2025-0028',
                'camion_id' => 27, // Q-302VWX
                'piloto_id' => 36, // Rolando César Medina
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 5, // Bodega SV Central
                'estado' => 'cancelada',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4)
            ],
            [
                'numero_orden' => 'OT-2025-0029',
                'camion_id' => 34, // FP-504NOP
                'piloto_id' => 44, // Stephanie Nicole Ramos
                'predio_id' => 4, // Predio Santa Ana
                'bodega_id' => 7, // Bodega Santa Ana
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2)
            ],
            [
                'numero_orden' => 'OT-2025-0030',
                'camion_id' => 38, // V-601WXY
                'piloto_id' => 50, // Melissa Andrea Cortés
                'predio_id' => 1, // Predio Central Guatemala
                'bodega_id' => 1, // Bodega A
                'estado' => 'completada',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDay()
            ],
            [
                'numero_orden' => 'OT-2025-0031',
                'camion_id' => 42, // RM-700CDE
                'piloto_id' => 55, // Roberto Morales
                'predio_id' => 2, // Predio Norte Guatemala
                'bodega_id' => 4, // Bodega Norte 2
                'estado' => 'en_proceso',
                'created_at' => Carbon::now()->subHours(20),
                'updated_at' => Carbon::now()->subHours(3)
            ],
            [
                'numero_orden' => 'OT-2025-0032',
                'camion_id' => 45, // SF-100LMN
                'piloto_id' => 58, // Sandra Flores
                'predio_id' => 3, // Predio San Salvador Central
                'bodega_id' => 6, // Bodega SV Exportación
                'estado' => 'pendiente',
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(30)
            ]
        ];

        foreach ($ordenes as $orden) {
            OrdenTrabajo::create($orden);
        }
    }
}
