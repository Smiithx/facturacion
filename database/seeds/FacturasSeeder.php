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
        $contratos = \App\ordenservicios::select('id_contrato')->where('facturado', '0')->groupBy('id_contrato')->get();

        foreach ($contratos as $contrato) {
            $contrato = $contrato->id_contrato->id;

            $factura = \App\Factura::create([
                'id_contrato' => $contrato,
                'radicada' => 0
            ]);

            $ordenes = App\ordenservicios::where('id_contrato', $contrato)->get();
            $num_ordenes = count($ordenes);
            $count_ordenes_facturar = $faker->numberBetween(1, $num_ordenes);

            $ordenes = $count_ordenes_facturar > 1 ? $ordenes->random($count_ordenes_facturar) : $ordenes;

            $factura_total = 0;
            foreach ($ordenes as $orden) {
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
