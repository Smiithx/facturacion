<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ordendeservicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordendeservicio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',120);            
            $table->string('documento',120);
            $table->integer('aseguradora_id')->unsigned();
            $table->foreign('aseguradora_id')->references('id')->on('aseguradoras');
            $table->integer('id_paciente')->unsigned();
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->integer('id_contrato')->unsigned();
            $table->foreign('id_contrato')->references('id')->on('contratos');
            $table->decimal('orden_total', 42, 2);
            $table->boolean('facturado');
            $table->boolean('anulado');
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
        Schema::drop('ordendeservicio');
    }
}
