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
             $table->enum('tipomanual', array('ISS2001','SOAT','PARTICULAR','OTRO'));  
            $table->integer('servicios_id')->index();
            $table->string('codigosoat',50);
            $table->decimal('costo', 42, 2); 
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
