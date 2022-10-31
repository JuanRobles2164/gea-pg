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
            ],
            [
                'id' => 4,
                'nombre' => 'En Desarrollo',
                'descripcion' => 'Una entidad que está en desarrollo. Puede ser una licitacion o una fase',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 5,
                'nombre' => 'Finalizado',
                'descripcion' => 'Estado Finalizada',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 6,
                'nombre' => 'Deshabilitado',
                'descripcion' => 'Estado deshabilitada',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 7,
                'nombre' => 'Estado inicial',
                'descripcion' => 'Estado por definir',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 8,
                'nombre' => 'Aprobado',
                'descripcion' => 'Estado ganada, por definir',
                'updated_at' => now(),
                'created_at' => now()
            ],
            [
                'id' => 9,
                'nombre' => 'Rechazado',
                'descripcion' => 'Estado clausurada',
                'updated_at' => now(),
                'created_at' => now()
            ]
        ];
        DB::table('estado')
        ->insert($data);
    }
}
