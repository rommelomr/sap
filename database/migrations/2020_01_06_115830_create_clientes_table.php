<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');

            $table->unsignedBigInteger('id_ciudad_expedicion');
            $table->foreign('id_ciudad_expedicion')->references('id')->on('ciudades')->onDelete('cascade');

            $table->unsignedBigInteger('id_ciudad_residencia');
            $table->foreign('id_ciudad_residencia')->references('id')->on('ciudades')->onDelete('cascade');

            $table->unsignedBigInteger('id_ubicacion');
            $table->foreign('id_ubicacion')->references('id')->on('ubicaciones')->onDelete('cascade');

            $table->string('carnet', 250);

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
        Schema::dropIfExists('clientes');
    }
}
