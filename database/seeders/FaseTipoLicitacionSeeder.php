<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaseTipoLicitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fase_tipo_licitacion')->insert([[
            'id' => 1,
            'orden' => 1,
            'fase' => 1,
            'tipo_licitacion' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'orden' => 2,
            'fase' => 2,
            'tipo_licitacion' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'orden' => 3,
            'fase' => 3,
            'tipo_licitacion' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 4,
            'orden' => 1,
            'fase' => 1,
            'tipo_licitacion' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 5,
            'orden' => 2,
            'fase' => 2,
            'tipo_licitacion' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 6,
            'orden' => 3,
            'fase' => 3,
            'tipo_licitacion' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 7,
            'orden' => 4,
            'fase' => 4,
            'tipo_licitacion' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 8,
            'orden' => 5,
            'fase' => 5,
            'tipo_licitacion' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 9,
            'orden' => 1,
            'fase' => 4,
            'tipo_licitacion' => 3,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 10,
            'orden' => 2,
            'fase' => 5,
            'tipo_licitacion' => 3,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}
