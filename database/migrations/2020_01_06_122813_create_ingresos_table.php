<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_ingreso');
            $table->foreign('id_tipo_ingreso')->references('id')->on('tipos_ingreso')->onDelete('cascade');
            $table->text('concepto');
            $table->unsignedBigInteger('id_tipo_pago');
            $table->foreign('id_tipo_pago')->references('id')->on('tipos_pago')->onDelete('cascade');
            $table->bigInteger('numero_recibo');
            $table->double('monto',10,2);
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
        Schema::dropIfExists('ingresos');
    }
}
