<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturaItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_factura')->unsigned();
            $table->integer('id_orden_servicio')->unsigned();

            $table->foreign('id_factura')->references('id')->on('facturas');
            $table->foreign('id_orden_servicio')->references('id')->on('ordendeservicio');

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
        Schema::drop('factura_items');
    }
}
