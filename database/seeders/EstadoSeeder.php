<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'nombre' => 'Activo',
                'descripcion' => 'Estado activo',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 2,
                'nombre' => 'Inactivo',
                'descripcion' => 'Estado inactivo',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 3,
                'nombre' => 'Eliminado',
                'descripcion' => 'Estado eliminado',
                'updated_at' => now(),
                'created_at' => now()
            ]
        ];
        DB::table('estado')
        ->insert($data);
    }
}
