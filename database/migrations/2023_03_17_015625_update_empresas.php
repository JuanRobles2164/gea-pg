<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {
            $table->string('representante_identificacion');
            $table->string('digito_verificacion');
            $table->string('representante_legal');
            //La ruta, no el archivo
            $table->string('representante_legal_firma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
