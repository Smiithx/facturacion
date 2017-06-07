<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function(Blueprint $table){
            $table->increments('id');
            $table->string('documento')->unique();
            $table->enum('tipo_documento', array('CC', 'TI','RC','CE','AS','MS','PA'));
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->enum('sexo', array('Masculino','Femenino'));
            $table->string('telefono');
            $table->string('direccion');
            $table->enum('regimen', array('Contributivo', 'Subsidiado','Vinculado','Particular','Otro','Desplazado Contributivo','Desplazado Subsidiado','Desplazado Vinculado'));
            $table->integer('aseguradora_id')->unsigned();
            $table->foreign('aseguradora_id')->references('id')->on('aseguradoras');
            $table->integer('id_contrato')->unsigned();
            $table->foreign('id_contrato')->references('id')->on('contratos');
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
        Schema::drop('pacientes');
    }
}
