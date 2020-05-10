<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');

            $table->unsignedBigInteger('id_nivel_academico')->nullable();
            $table->foreign('id_nivel_academico')->references('id')->on('niveles_academicos')->onDelete('cascade');

            $table->unsignedBigInteger('id_tipo_cotizacion')->nullable();
            $table->foreign('id_tipo_cotizacion')->references('id')->on('tipos_cotizacion')->onDelete('cascade');

            $table->tinyInteger('curso')->nullable();

            $table->char('paralelo',1)->nullable();

            $table->unsignedBigInteger('id_medio')->nullable();
            $table->foreign('id_medio')->references('id')->on('medios')->onDelete('cascade');

            $table->unsignedBigInteger('id_modalidad')->nullable();
            $table->foreign('id_modalidad')->references('id')->on('modalidades')->onDelete('cascade');
            
            $table->text('tema')->nullable();

            $table->integer('avance')->nullable()->dafault(0);

            $table->text('observaciones')->nullable();

            $table->integer('precio_total')->nullable();

            $table->integer('validez')->nullable();


            $table->timestamps();
        });
        DB::statement("ALTER TABLE cotizaciones AUTO_INCREMENT = 50;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
}
