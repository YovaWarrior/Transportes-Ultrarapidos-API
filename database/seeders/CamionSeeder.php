<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camion;

class CamionSeeder extends Seeder
{
    public function run()
    {
        $camiones = [
            // Camiones de Transportes Guatemala S.A. (transportista_id: 1) - 8 camiones
            [
                'transportista_id' => 1,
                'placa' => 'P-001AAA',
                'tipo' => 'Plataforma',
                'capacidad' => 25.00,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Freightliner',
                'modelo' => 'Cascadia'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-002BBB',
                'tipo' => 'Furgón',
                'capacidad' => 15.50,
                'estado' => 'activo',
                'año' => 2019,
                'marca' => 'Volvo',
                'modelo' => 'FH'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-003CCC',
                'tipo' => 'Refrigerado',
                'capacidad' => 20.00,
                'estado' => 'mantenimiento',
                'año' => 2021,
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Actros'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-004DDD',
                'tipo' => 'Plataforma',
                'capacidad' => 30.00,
                'estado' => 'activo',
                'año' => 2022,
                'marca' => 'Scania',
                'modelo' => 'R500'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-005EEE',
                'tipo' => 'Furgón',
                'capacidad' => 18.75,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'DAF',
                'modelo' => 'XF'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-006FFF',
                'tipo' => 'Refrigerado',
                'capacidad' => 22.50,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Iveco',
                'modelo' => 'Stralis'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-007GGG',
                'tipo' => 'Tanque',
                'capacidad' => 35.00,
                'estado' => 'activo',
                'año' => 2019,
                'marca' => 'MAN',
                'modelo' => 'TGX'
            ],
            [
                'transportista_id' => 1,
                'placa' => 'P-008HHH',
                'tipo' => 'Plataforma',
                'capacidad' => 28.00,
                'estado' => 'fuera_servicio',
                'año' => 2018,
                'marca' => 'Renault',
                'modelo' => 'T High'
            ],

            // Camiones de Logística Maya (transportista_id: 2) - 6 camiones
            [
                'transportista_id' => 2,
                'placa' => 'M-100XYZ',
                'tipo' => 'Plataforma',
                'capacidad' => 30.00,
                'estado' => 'activo',
                'año' => 2018,
                'marca' => 'Kenworth',
                'modelo' => 'T680'
            ],
            [
                'transportista_id' => 2,
                'placa' => 'M-101ABC',
                'tipo' => 'Furgón',
                'capacidad' => 18.75,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Scania',
                'modelo' => 'R450'
            ],
            [
                'transportista_id' => 2,
                'placa' => 'M-102DEF',
                'tipo' => 'Refrigerado',
                'capacidad' => 25.00,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Volvo',
                'modelo' => 'FH16'
            ],
            [
                'transportista_id' => 2,
                'placa' => 'M-103GHI',
                'tipo' => 'Plataforma',
                'capacidad' => 32.50,
                'estado' => 'mantenimiento',
                'año' => 2019,
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Arocs'
            ],
            [
                'transportista_id' => 2,
                'placa' => 'M-104JKL',
                'tipo' => 'Furgón',
                'capacidad' => 20.00,
                'estado' => 'activo',
                'año' => 2022,
                'marca' => 'DAF',
                'modelo' => 'CF'
            ],
            [
                'transportista_id' => 2,
                'placa' => 'M-105MNO',
                'tipo' => 'Tanque',
                'capacidad' => 40.00,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Iveco',
                'modelo' => 'S-Way'
            ],

            // Camiones de Transportes del Norte (transportista_id: 3) - 7 camiones
            [
                'transportista_id' => 3,
                'placa' => 'TN-400JKL',
                'tipo' => 'Plataforma',
                'capacidad' => 28.00,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Mack',
                'modelo' => 'Anthem'
            ],
            [
                'transportista_id' => 3,
                'placa' => 'TN-401MNO',
                'tipo' => 'Tanque',
                'capacidad' => 35.00,
                'estado' => 'fuera_servicio',
                'año' => 2016,
                'marca' => 'Peterbilt',
                'modelo' => '579'
            ],
            [
                'transportista_id' => 3,
                'placa' => 'TN-402PQR',
                'tipo' => 'Furgón',
                'capacidad' => 22.50,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'DAF',
                'modelo' => 'XF'
            ],
            [
                'transportista_id' => 3,
                'placa' => 'TN-403STU',
                'tipo' => 'Plataforma',
                'capacidad' => 26.50,
                'estado' => 'activo',
                'año' => 2019,
                'marca' => 'Scania',
                'modelo' => 'G450'
            ],
            [
                'transportista_id' => 3,
                'placa' => 'TN-404VWX',
                'tipo' => 'Refrigerado',
                'capacidad' => 24.00,
                'estado' => 'mantenimiento',
                'año' => 2021,
                'marca' => 'Volvo',
                'modelo' => 'FM'
            ],
            [
                'transportista_id' => 3,
                'placa' => 'TN-405YZA',
                'tipo' => 'Furgón',
                'capacidad' => 19.50,
                'estado' => 'activo',
                'año' => 2022,
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Atego'
            ],
            [
                'transportista_id' => 3,
                'placa' => 'TN-406BCD',
                'tipo' => 'Plataforma',
                'capacidad' => 31.00,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'MAN',
                'modelo' => 'TGS'
            ],

            // Camiones de Cargo Express Centroamérica (transportista_id: 4) - 5 camiones
            [
                'transportista_id' => 4,
                'placa' => 'CE-200ABC',
                'tipo' => 'Plataforma',
                'capacidad' => 27.50,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Freightliner',
                'modelo' => 'Coronado'
            ],
            [
                'transportista_id' => 4,
                'placa' => 'CE-201DEF',
                'tipo' => 'Furgón',
                'capacidad' => 16.75,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Iveco',
                'modelo' => 'Daily'
            ],
            [
                'transportista_id' => 4,
                'placa' => 'CE-202GHI',
                'tipo' => 'Refrigerado',
                'capacidad' => 21.25,
                'estado' => 'mantenimiento',
                'año' => 2019,
                'marca' => 'Scania',
                'modelo' => 'P320'
            ],
            [
                'transportista_id' => 4,
                'placa' => 'CE-203JKL',
                'tipo' => 'Plataforma',
                'capacidad' => 29.00,
                'estado' => 'activo',
                'año' => 2022,
                'marca' => 'Volvo',
                'modelo' => 'FMX'
            ],
            [
                'transportista_id' => 4,
                'placa' => 'CE-204MNO',
                'tipo' => 'Tanque',
                'capacidad' => 38.50,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'DAF',
                'modelo' => 'XF105'
            ],

            // Camiones de Transportes Quetzal (transportista_id: 5) - 4 camiones
            [
                'transportista_id' => 5,
                'placa' => 'Q-300PQR',
                'tipo' => 'Furgón',
                'capacidad' => 17.50,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Actros'
            ],
            [
                'transportista_id' => 5,
                'placa' => 'Q-301STU',
                'tipo' => 'Plataforma',
                'capacidad' => 26.00,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'MAN',
                'modelo' => 'TGX'
            ],
            [
                'transportista_id' => 5,
                'placa' => 'Q-302VWX',
                'tipo' => 'Refrigerado',
                'capacidad' => 23.75,
                'estado' => 'fuera_servicio',
                'año' => 2017,
                'marca' => 'Renault',
                'modelo' => 'T460'
            ],
            [
                'transportista_id' => 5,
                'placa' => 'Q-303YZA',
                'tipo' => 'Furgón',
                'capacidad' => 18.25,
                'estado' => 'activo',
                'año' => 2022,
                'marca' => 'Iveco',
                'modelo' => 'Eurocargo'
            ],

            // Camiones de Flota Pesada Guatemala (transportista_id: 6) - 6 camiones
            [
                'transportista_id' => 6,
                'placa' => 'FP-500BCD',
                'tipo' => 'Plataforma',
                'capacidad' => 33.50,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Caterpillar',
                'modelo' => 'CT660'
            ],
            [
                'transportista_id' => 6,
                'placa' => 'FP-501EFG',
                'tipo' => 'Tanque',
                'capacidad' => 42.00,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Kenworth',
                'modelo' => 'T800'
            ],
            [
                'transportista_id' => 6,
                'placa' => 'FP-502HIJ',
                'tipo' => 'Plataforma',
                'capacidad' => 31.75,
                'estado' => 'mantenimiento',
                'año' => 2019,
                'marca' => 'Peterbilt',
                'modelo' => '389'
            ],
            [
                'transportista_id' => 6,
                'placa' => 'FP-503KLM',
                'tipo' => 'Furgón',
                'capacidad' => 25.50,
                'estado' => 'activo',
                'año' => 2022,
                'marca' => 'Mack',
                'modelo' => 'Granite'
            ],
            [
                'transportista_id' => 6,
                'placa' => 'FP-504NOP',
                'tipo' => 'Refrigerado',
                'capacidad' => 27.25,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Western Star',
                'modelo' => '4700'
            ],
            [
                'transportista_id' => 6,
                'placa' => 'FP-505QRS',
                'tipo' => 'Plataforma',
                'capacidad' => 34.00,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'International',
                'modelo' => 'LT625'
            ],

            // Camiones de Transportes Volcán (transportista_id: 7) - 3 camiones
            [
                'transportista_id' => 7,
                'placa' => 'V-600TUV',
                'tipo' => 'Furgón',
                'capacidad' => 19.75,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Hino',
                'modelo' => '500 Series'
            ],
            [
                'transportista_id' => 7,
                'placa' => 'V-601WXY',
                'tipo' => 'Plataforma',
                'capacidad' => 28.50,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Fuso',
                'modelo' => 'Super Great'
            ],
            [
                'transportista_id' => 7,
                'placa' => 'V-602ZAB',
                'tipo' => 'Tanque',
                'capacidad' => 36.75,
                'estado' => 'mantenimiento',
                'año' => 2019,
                'marca' => 'UD Trucks',
                'modelo' => 'Quon'
            ],

            // Camiones de transportistas independientes (transportista_id: 8-19) - 1 camión cada uno
            [
                'transportista_id' => 8,
                'placa' => 'C-500DEF',
                'tipo' => 'Carga General',
                'capacidad' => 12.50,
                'estado' => 'activo',
                'año' => 2017,
                'marca' => 'Isuzu',
                'modelo' => 'NPR'
            ],
            [
                'transportista_id' => 9,
                'placa' => 'MG-200GHI',
                'tipo' => 'Furgón',
                'capacidad' => 10.00,
                'estado' => 'activo',
                'año' => 2019,
                'marca' => 'Hino',
                'modelo' => '300'
            ],
            [
                'transportista_id' => 10,
                'placa' => 'RM-700CDE',
                'tipo' => 'Plataforma',
                'capacidad' => 15.75,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Mitsubishi',
                'modelo' => 'Canter'
            ],
            [
                'transportista_id' => 11,
                'placa' => 'AL-800FGH',
                'tipo' => 'Furgón',
                'capacidad' => 11.25,
                'estado' => 'mantenimiento',
                'año' => 2018,
                'marca' => 'Foton',
                'modelo' => 'Aumark'
            ],
            [
                'transportista_id' => 12,
                'placa' => 'LC-900IJK',
                'tipo' => 'Carga General',
                'capacidad' => 13.50,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'JAC',
                'modelo' => 'N Series'
            ],
            [
                'transportista_id' => 13,
                'placa' => 'SF-100LMN',
                'tipo' => 'Furgón',
                'capacidad' => 9.75,
                'estado' => 'activo',
                'año' => 2019,
                'marca' => 'Dongfeng',
                'modelo' => 'Captain'
            ],
            [
                'transportista_id' => 14,
                'placa' => 'DM-110OPQ',
                'tipo' => 'Plataforma',
                'capacidad' => 14.25,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Hyundai',
                'modelo' => 'Mighty'
            ],
            [
                'transportista_id' => 15,
                'placa' => 'RH-120RST',
                'tipo' => 'Carga General',
                'capacidad' => 12.00,
                'estado' => 'fuera_servicio',
                'año' => 2016,
                'marca' => 'Chevrolet',
                'modelo' => 'NPR'
            ],
            [
                'transportista_id' => 16,
                'placa' => 'JR-130UVW',
                'tipo' => 'Furgón',
                'capacidad' => 10.50,
                'estado' => 'activo',
                'año' => 2021,
                'marca' => 'Ford',
                'modelo' => 'Cargo'
            ],
            [
                'transportista_id' => 17,
                'placa' => 'CV-140XYZ',
                'tipo' => 'Plataforma',
                'capacidad' => 16.00,
                'estado' => 'activo',
                'año' => 2019,
                'marca' => 'Volkswagen',
                'modelo' => 'Delivery'
            ],
            [
                'transportista_id' => 18,
                'placa' => 'MR-150ABC',
                'tipo' => 'Carga General',
                'capacidad' => 11.75,
                'estado' => 'activo',
                'año' => 2020,
                'marca' => 'Renault',
                'modelo' => 'Master'
            ],
            [
                'transportista_id' => 19,
                'placa' => 'PJ-160DEF',
                'tipo' => 'Furgón',
                'capacidad' => 13.25,
                'estado' => 'mantenimiento',
                'año' => 2018,
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Sprinter'
            ]
        ];

        foreach ($camiones as $camion) {
            Camion::create($camion);
        }
    }
}
