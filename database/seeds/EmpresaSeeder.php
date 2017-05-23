<?php

use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Empresa::create([
            'rezon_social' => 'Casolucion',
            'nit' => 'NIT-!294324932894',
            'representante' => 'Carlos Alberto Leon',
            'direccion' => 'Colombia, santander',
            'telefono' => '0500 000 12345',
            'file' => 'casolucion.png'
        ]);
    }
}
