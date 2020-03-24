<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_cliente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ingreso');
            $table->foreign('id_ingreso')->references('id')->on('ingresos')->onDelete('cascade');

            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('id_modalidad');
            $table->foreign('id_modalidad')->references('id')->on('modalidades')->onDelete('cascade');

            $table->unsignedBigInteger('id_ficha_economica');
            $table->foreign('id_ficha_economica')->references('id')->on('fichas_economicas')->onDelete('cascade');
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
        Schema::dropIfExists('pagos_cliente');
    }
}
