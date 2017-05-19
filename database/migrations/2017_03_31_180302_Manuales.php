<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Manuales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuales', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', array('ISS2001','SOAT','PARTICULAR','OTRO'));
            $table->string('codigosoat',50)->unique();
            $table->enum('estado', array('Activo','Inactivo'));   
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
        Schema::drop('manuales');

    }
}
