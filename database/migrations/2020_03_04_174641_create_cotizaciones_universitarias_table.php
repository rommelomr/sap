<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesUniversitariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones_universitarias', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_cotizacion')->nullable();
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones')->onDelete('cascade');
            
            $table->unsignedBigInteger('id_universidad')->nullable();
            $table->foreign('id_universidad')->references('id')->on('universidades')->onDelete('cascade');

            $table->unsignedBigInteger('id_profesion')->nullable();
            $table->foreign('id_profesion')->references('id')->on('profesiones')->onDelete('cascade');

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
        Schema::dropIfExists('cotizaciones_universitarias');
    }
}
