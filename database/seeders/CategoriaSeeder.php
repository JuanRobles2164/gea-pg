<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
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
                'nombre' => '2018',
                'descripcion' => 'Licitaciones creadas en el 2018',
                'css_style' => 'navajowhite',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nombre' => '2019',
                'descripcion' => 'Licitaciones creadas en el 2019',
                'css_style' => 'teal',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nombre' => '2020',
                'descripcion' => 'Licitaciones creadas en el 2020',
                'css_style' => 'black',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];
        DB::table('categoria')
        ->insert($data);
    }
}
