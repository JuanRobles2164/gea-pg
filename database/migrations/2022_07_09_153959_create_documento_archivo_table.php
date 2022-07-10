<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_archivo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("documento_id");
            $table->unsignedBigInteger("archivo_id");
            $table->timestamps();

            $table->foreign('documento_id')->references('id')->on('documento');
            $table->foreign('archivo_id')->references('id')->on('archivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_archivo');
    }
}
