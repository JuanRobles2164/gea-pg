<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')
        ->insert([[
            'id' => 1,
            'nombre' => 'ADMIN',
            'descripcion' => 'Rol de Admin',
            'estado' => '1'
        ],
        [
            'id' => 2,
            'nombre' => 'Gerente',
            'descripcion' => 'Rol de gerente', 
            'estado' => '1'
        ],
        [
            'id' => 3,
            'nombre' => 'Operario',
            'descripcion' => 'Rol de operario',
            'estado' => '1'
        ]]);
    }
}
