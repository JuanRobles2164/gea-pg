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
            $table->string("nombre");
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->boolean("clonado");
            $table->unsignedBigInteger("cliente");
            $table->unsignedBigInteger("estado");
            $table->unsignedBigInteger("categoria");
            $table->timestamps();

            $table->foreign('cliente')->references('id')->on('cliente');
            $table->foreign('estado')->references('id')->on('estado');
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
