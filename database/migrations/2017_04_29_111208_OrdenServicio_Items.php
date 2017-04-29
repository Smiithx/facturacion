<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdenServicioItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_servicio_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_orden_servicio')->references('id')->on('ordendeservicio');
            $table->string('cups',50);
            $table->string('descripcion',100);
            $table->decimal('cantidad', 42, 2);
            $table->decimal('copago', 42, 2);
            $table->decimal('valor_unitario', 42, 2);
            $table->decimal('valor_total', 42, 2);
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
        Schema::drop('orden_servicio_items');
    }
}
