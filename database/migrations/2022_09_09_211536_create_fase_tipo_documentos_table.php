<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseTipoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_tipo_documento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tipo_documento");
            $table->unsignedBigInteger("fase");
            $table->unsignedBigInteger('estado')->default(1);
            $table->timestamps();

            $table->foreign('tipo_documento')->references('id')->on('tipo_documento');
            $table->foreign('fase')->references('id')->on('fase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_tipo_documento');
    }
}
