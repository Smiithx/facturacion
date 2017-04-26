<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Diagnosticos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
       Schema::create('diagnosticos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',50);
            $table->string('descripcion',50);
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
        Schema::drop('diagnosticos');    }
}
