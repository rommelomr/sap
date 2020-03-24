<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionesFichaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones_ficha', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ficha');
            $table->foreign('id_ficha')->references('id')->on('fichas_academicas')->onDelete('cascade');
            $table->text('observacion', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observaciones_ficha');
    }
}
