<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitacion', function (Blueprint $table) {
            $table->id();
            $table->string("numero");
            $table->string("nombre");
            $table->longText("descripcion");
            $table->date("fecha_inicio");
            $table->date("fecha_fin")->nullable();
            $table->string("observacion")->nullable();
            $table->unsignedBigInteger('estado')->default(1);
            $table->unsignedBigInteger("cliente");
            $table->unsignedBigInteger("tipo_licitacion");
            $table->unsignedBigInteger("categoria");
            $table->timestamps();

            $table->foreign('cliente')->references('id')->on('cliente');
            $table->foreign('tipo_licitacion')->references('id')->on('tipo_licitacion');
            $table->foreign('categoria')->references('id')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licitacion');
    }
}
