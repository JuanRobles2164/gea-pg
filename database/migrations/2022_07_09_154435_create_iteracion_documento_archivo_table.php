<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIteracionDocumentoArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iteracion_documento_archivo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("documento_archivo_id");
            $table->unsignedBigInteger("iteracion_id");
            $table->timestamps();

            $table->foreign("documento_archivo_id")->references("id")->on("documento_archivo");
            $table->foreign("iteracion_id")->references("id")->on("iteracion");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iteracion_documento_archivo');
    }
}
