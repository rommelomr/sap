<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones_generales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cotizacion')->nullable();
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones')->onDelete('cascade');

            $table->unsignedBigInteger('id_facultad')->nullable();
            $table->foreign('id_facultad')->references('id')->on('facultades')->onDelete('cascade');
            $table->unsignedBigInteger('id_carrera')->nullable();
            $table->foreign('id_carrera')->references('id')->on('carreras')->onDelete('cascade');
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
        Schema::dropIfExists('cotizaciones_generales');
    }
}
