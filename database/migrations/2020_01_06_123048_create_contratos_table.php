<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('numero_contrato',10)->nullable();
            $table->unsignedBigInteger('id_asesor');
            $table->foreign('id_asesor')->references('id')->on('asesores')->onDelete('cascade');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('id_tipo_contrato');
            $table->foreign('id_tipo_contrato')->references('id')->on('tipos_contrato')->onDelete('cascade');
            $table->double('monto',15,2);
            $table->unsignedBigInteger('daf');
            $table->foreign('daf')->references('id')->on('personas')->onDelete('cascade');
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
        Schema::dropIfExists('contratos');
    }
}
