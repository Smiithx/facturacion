<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Glosas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glosas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura');
            $table->string('contrato',50);
            $table->decimal('valor_glosa', 42, 2);
            $table->decimal('valor_aceptado', 42, 2);
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
        Schema::drop('facturas');
    }
}