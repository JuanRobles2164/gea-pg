<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseTipoLicitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_tipo_licitacion', function (Blueprint $table) {
            $table->id();
            $table->integer("orden");
            $table->unsignedBigInteger("fase");
            $table->unsignedBigInteger("tipo_licitacion");
            $table->timestamps();

            $table->foreign('fase')->references('id')->on('fase');
            $table->foreign('tipo_licitacion')->references('id')->on('tipo_licitacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_tipo_licitacion');
    }
}
