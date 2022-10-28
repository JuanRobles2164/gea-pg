<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            UsersTableSeeder::class,
            ClienteSeeder::class,
            TipoLicitacionSeeder::class,
            CategoriaSeeder::class,
            LicitacionSeeder::class,
            FaseSeeder::class,
            FaseTipoLicitacionSeeder::class,
            LicitacionFaseSeeder::class,
            TipoDocumentoSeeder::class,
            FaseTipoDocumentoSeeder::class,
            DocumentoSeeder::class,
            DocumentoLicitacionSeeder::class,
            RolSeeder::class,
            RolUsuarioSeeder::class
        ]);
    }
}
