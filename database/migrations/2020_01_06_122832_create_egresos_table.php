<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo_egreso');
            $table->foreign('id_tipo_egreso')->references('id')->on('tipos_egreso')->onDelete('cascade');
            $table->unsignedBigInteger('id_tipo_pago');
            $table->foreign('id_tipo_pago')->references('id')->on('tipos_pago')->onDelete('cascade');
            $table->text('concepto');
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
        Schema::dropIfExists('egresos');
    }
}
