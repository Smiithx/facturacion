<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Empresa as App_empresa;

class Empresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rezon_social');
            $table->string('nit');
            $table->string('representante');
             $table->string('direccion');
            $table->string('telefono');
            $table->string('file');
            $table->timestamps();
        });
        App_empresa::create([
           'rezon_social' => 'Casolucion',
           'nit' => 'NIT-!294324932894',
           'representante' => 'Carlos Alberto Leon',
           'direccion' => 'Colombia, santander',
           'telefono' => '0500 000 12345',
           'file' => 'casolucion.png'
       ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
