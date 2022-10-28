<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert([[
            'id' => 1,
            'razon_social' => 'Colegio La Salle',
            'email' => 'lasalle@gmail.com',
            'direccion' => 'Cl. 67 #24-24, Bucaramanga',
            'identificacion' => '8001972684',
            'tipo_identificacion' => 'NIT',
            'telefono' => '6437535',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'razon_social' => 'Colegio Reggio Amelia',
            'email' => 'reggioamelia@gmail.com',
            'direccion' => 'Cra. 34 #54-31, Bucaramanga',
            'identificacion' => '7893453251',
            'tipo_identificacion' => 'NIT',
            'telefono' => '3164823052',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'razon_social' => 'Colegio Jorge Isaac',
            'email' => 'jorgeisaac@gmail.com',
            'direccion' => 'Cl. 106 #29-47, Bucaramanga',
            'identificacion' => '5985147561',
            'tipo_identificacion' => 'NIT',
            'telefono' => '3017431120',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 4,
            'razon_social' => 'Colegio de la Presentación',
            'email' => 'lapresentacion@gmail.com',
            'direccion' => 'Cl. 56 #33-38, Bucaramanga',
            'identificacion' => '4139584521',
            'tipo_identificacion' => 'NIT',
            'telefono' => '76437253',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 5,
            'razon_social' => 'Colegio San Pedro Claver',
            'email' => 'sanpedroclaver@gmail.com',
            'direccion' => 'Cra. 28 #47-06, Bucaramanga',
            'identificacion' => '7689127461',
            'tipo_identificacion' => 'NIT',
            'telefono' => '76972727',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]]);
    }
}
