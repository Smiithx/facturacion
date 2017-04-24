<?php

use Illuminate\Database\Seeder;
use App\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Empresa::create([
           'rezon_social' => 'Casolucion',
           'nit' => 'NIT-!294324932894',
           'representante' => 'Carlos Alberto Leon',
           'direccion' => 'Colombia, santander',
           'telefono' => '0500 000 12345',
           'logo' => 'casolucion.png'
       ]);
        
        
    }
}
