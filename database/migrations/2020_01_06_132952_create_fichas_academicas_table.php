<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_academicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('id_asesor')->nullable();
            $table->foreign('id_asesor')->references('id')->on('asesores')->onDelete('cascade');
            $table->unsignedBigInteger('id_contrato')->nullable();
            $table->foreign('id_contrato')->references('id')->on('contratos')->onDelete('cascade');
            $table->unsignedBigInteger('id_cotizacion');
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones')->onDelete('cascade');
            //$table->unsignedBigInteger('id_nivel_academico')->nullable();
            //$table->foreign('id_nivel_academico')->references('id')->on('niveles_academicos')->onDelete('cascade');
            //$table->unsignedBigInteger('id_curso')->nullable();
            //$table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->integer('plazo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->unsignedBigInteger('id_etapa')->nullable();
            $table->foreign('id_etapa')->references('id')->on('etapas')->onDelete('cascade');
            $table->tinyInteger('estado')->default(0);
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
        Schema::dropIfExists('fichas_academicas');
    }
}
