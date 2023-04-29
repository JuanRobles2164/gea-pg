<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol_usuario')->insert([[
            'id' => 1,
            'usuario' => 1,
            'rol' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'usuario' => 2,
            'rol' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'usuario' => 3,
            'rol' => 1,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 4,
            'usuario' => 4,
            'rol' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 5,
            'usuario' => 5,
            'rol' => 3,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 6,
            'usuario' => 2,
            'rol' => 2,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 7,
            'usuario' => 2,
            'rol' => 3,
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]
        ]);
    }
}
