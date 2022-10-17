<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("descripcion")->nullable();
            $table->unsignedBigInteger("estado");
            $table->timestamps();
        });
        DB::table('rol')
        ->insert([[
            'id' => 1,
            'nombre' => 'Gerente',
            'descripcion' => 'Rol de gerente'
        ],
        [
            'id' => 2,
            'nombre' => 'Usuario',
            'descripcion' => 'Rol de usuario'
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol');
    }
}
