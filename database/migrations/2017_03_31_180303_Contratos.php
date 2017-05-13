<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50)->unique();
            $table->string('nit', 50);
            $table->integer('diasvencimiento');
            $table->integer('id_manual')->unsigned();
            $table->foreign('id_manual')->references('id')->on('manuales');
            $table->decimal('porcentaje', 42, 2);
            $table->enum('estado', array('Activo', 'Inactivo'));
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
        Schema::drop('contratos');

    }
}
