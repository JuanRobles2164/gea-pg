<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->binary("data_file")->nullable();
            $table->string("data_json")->nullable();
            $table->string("path_file")->nullable();
            $table->unsignedBigInteger("tipo_documento");
            $table->timestamps();

            $table->foreign('tipo_documento')->references('id')->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
