<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesPosgradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones_posgrado', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_cotizacion_universitaria')->nullable();
            $table->foreign('id_cotizacion_universitaria')->references('id')->on('cotizaciones_universitarias')->onDelete('cascade');
            
            $table->unsignedBigInteger('id_posgrado')->nullable();
            $table->foreign('id_posgrado')->references('id')->on('posgrados')->onDelete('cascade');
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
        Schema::dropIfExists('cotizaciones_posgrado');
    }
}
