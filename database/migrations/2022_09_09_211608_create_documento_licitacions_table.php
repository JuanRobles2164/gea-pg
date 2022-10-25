<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoLicitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_licitacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("documento");
            $table->unsignedBigInteger("licitacion_fase");
            $table->boolean("revisado");
            $table->timestamps();

            $table->foreign('documento')->references('id')->on('documento');
            $table->foreign('licitacion_fase')->references('id')->on('licitacion_fase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_licitacion');
    }
}
