<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cartera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cartera', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura')->unsigned();
            $table->foreign('id_factura')->references('id')->on('facturas');
            $table->date('fecha_vencimiento');
            $table->decimal('valor_abono', 42, 2);
            $table->decimal('valor_glosa', 42, 2);
            $table->decimal('valor_retencion', 42, 2);
            $table->decimal('valor_saldo', 42, 2);      
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
        Schema::drop('cartera');
    }
}
