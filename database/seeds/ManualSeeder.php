<?php

use Illuminate\Database\Seeder;
use App\Manuales;
class ManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [
            ['ISS2001'],
            ['SOAT'],
            ['PARTICULAR'],
            ['OTRO']
        ];
        foreach ($datos as $valor) {
            Manuales::create
            ([
                'nombre' => $valor[0],
                'estado' => 'Activo'
            ]);
        }
    }
}
