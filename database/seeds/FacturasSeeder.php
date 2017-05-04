<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FacturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $contratos = \App\ordenservicios::select('contrato')->where('facturado','0')->groupBy('contrato')->get();;
        $num_contratos = count($contratos);
        $count_contratos_facturar = $faker->numberBetween(1, $num_contratos);

        for ($i = 0; $i < $count_contratos_facturar; $i++) {
            $contrato = $contratos[$i]->contrato;

            $factura = \App\Factura::create([
                'contrato' => $contrato,
                'radicada' => 0
            ]);

            $ordenes = App\ordenservicios::where('contrato', $contrato)->get();
            $num_ordenes = count($ordenes);
            $count_ordenes_facturar = $faker->numberBetween(1, $num_ordenes);

            $factura_total = 0;

            for ($item = 0; $item < $count_ordenes_facturar; $item++) {
                $orden = $ordenes[$item];
                App\FacturaItems::create([
                    'id_factura' => $factura->id,
                    'id_orden_servicio' => $orden->id
                ]);
                $orden->facturado = 1;
                $orden->save();
                $factura_total += $orden->orden_total;
            }

            $factura->factura_total = $factura_total;
            $factura->save();

        }

    }
}
