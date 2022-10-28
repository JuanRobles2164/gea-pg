<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaseTipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fase_tipo_documento')->insert([[
            'id' => 1,
            'tipo_documento' => 1,
            'fase' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'tipo_documento' => 2,
            'fase' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'tipo_documento' => 3,
            'fase' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 4,
            'tipo_documento' => 9,
            'fase' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 5,
            'tipo_documento' => 5,
            'fase' => 3,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 6,
            'tipo_documento' => 6,
            'fase' => 3,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 7,
            'tipo_documento' => 7,
            'fase' => 4,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 8,
            'tipo_documento' => 2,
            'fase' => 4,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 9,
            'tipo_documento' => 4,
            'fase' => 5,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 10,
            'tipo_documento' => 8,
            'fase' => 5,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}
