<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitacion_fase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("fase");
            $table->unsignedBigInteger("licitacion");
            $table->unsignedBigInteger("estado");
            $table->timestamps();

            $table->foreign('fase')->references('id')->on('fase');
            $table->foreign('licitacion')->references('id')->on('licitacion');
            $table->foreign('estado')->references('id')->on('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licitacion_fase');
    }
}
