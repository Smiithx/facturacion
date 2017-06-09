<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManualesServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuales_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_manual')->unsigned();
            $table->string('codigosoat');
            $table->foreign('id_manual')->references('id')->on('manuales');
            $table->integer('id_servicio')->unsigned();
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->enum('estado', array('Activo', 'Inactivo'));
            $table->decimal('costo', 42, 2); 
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
         Schema::drop('manuales_servicios');
    }
}
