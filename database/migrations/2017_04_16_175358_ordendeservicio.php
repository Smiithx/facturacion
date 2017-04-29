<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ordendeservicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordendeservicio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',120);            
            $table->string('documento',120);            
            $table->integer('aseguradora_id')->index();
            $table->string('contrato',50);
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
        Schema::drop('ordendeservicio');
    }
}
