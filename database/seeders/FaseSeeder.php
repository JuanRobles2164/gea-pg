<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fase')->insert([[
            'id' => 1,
            'nombre' => 'fase 1',
            'descripcion' => 'Analisis de la propuesta',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'nombre' => 'fase 2',
            'descripcion' => 'Diseño de la propuesta',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'nombre' => 'fase 3',
            'descripcion' => 'Construcción de la propuesta',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 4,
            'nombre' => 'fase 4',
            'descripcion' => 'Implementacion de la propuesta',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 5,
            'nombre' => 'fase 5',
            'descripcion' => 'Mantenimiento de la propuesta',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]]);
    }
}
