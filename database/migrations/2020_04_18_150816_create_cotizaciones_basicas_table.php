<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesBasicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones_basicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cotizacion')->nullable();
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones')->onDelete('cascade');
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
        Schema::dropIfExists('cotizaciones_basicas');
    }
}
