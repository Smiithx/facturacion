<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Historia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia', function(Blueprint $table){
            $table->increments('id');
            $table->string('documento',15);
            $table->string('aseguradora',50);
            $table->string('contrato',50);
            $table->string('causaexterna',80);
            $table->string('finalidad',80);
            $table->string('motivoc',300);
            $table->string('enfermedadact',300);
            $table->string('antecedentesfam',300);
            $table->string('gravidez',20);
            $table->integer('partos');
            $table->integer('vaginales');
            $table->integer('cesareas');
            $table->integer('abortos');
            $table->integer('ectopicos');
            $table->integer('vivos');
            $table->integer('muertos');
            $table->string('menarca',20);
            $table->date('fum');
            $table->date('citologia');         
            $table->string('mplanificacion',20);
            $table->string('oantecedentesg',300);
            $table->string('rsistemas',300);
            $table->string('peso',10);
            $table->string('talla',6);
            $table->string('imc',10);
            $table->string('tarteria',10);
            $table->string('fcardiaca',10);
            $table->string('frespiratoria',10);
            $table->string('temperatura',10);
            $table->string('pulsioximetria',10);
            $table->string('examenf',300);
            $table->string('diagnostico',10);
            $table->string('descripcion',80);
            $table->string('soap',300);       
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
        Schema::drop('historia');
    }
}
