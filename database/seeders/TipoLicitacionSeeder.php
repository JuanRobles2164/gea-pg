<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoLicitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_licitacion')->insert([[
            'id' => 1,
            'nombre' => 'Licitación Pública',
            'descripcion' => 'Donde una entidad estatal realiza una convocatoria pública para que, en igualdad de oportunidades, los interesados presenten sus ofertas y el ente adjudique el contrato a la propuesta más acorde.',
            'estado' => '1',
            'indicativo' => 'LPU',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'nombre' => 'Licitación Privada',
            'descripcion' => 'Conllevan un proceso similar al de las licitaciones públicas, pero las invitaciones se hacen en forma expresa a determinadas empresas y no por anuncio público.',
            'estado' => '1',
            'indicativo' => 'LPR',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'nombre' => 'Concurso de Méritos',
            'descripcion' => 'procedimiento de selección que deben realizar las entidades estatales para escoger consultores y proyectos.',
            'estado' => '1',
            'indicativo' => 'CDM',
            'created_at' => now(),
            'updated_at' => now()
        ]]);
    }
}
