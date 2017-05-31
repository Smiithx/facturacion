<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Abonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   Schema::create('abonos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_factura');
            $table->string('descripcion',100);
            $table->decimal('valor_abono', 42, 2);
               $table->boolean('anulado');

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
