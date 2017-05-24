<?php

use Illuminate\Database\Seeder;
use App\ordenservicios;
use App\OrdenServicio_Items;
use App\Servicios;
use Faker\Factory as Faker;

class ItemOrdenServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $ordenes = ordenservicios::all();
        foreach ($ordenes as $orden) {
            $servicios = \App\Manuales_servicios::where("id_manual", $orden->id_contrato->id_manual->id)->where("estado", "Activo")->get();
            $count_servicios = count($servicios);
            $count_items = $faker->numberBetween(1, (($count_servicios > 10) ? 10 : $count_servicios));
            $orden_total = 0;
            $items = $count_servicios > 1 ? $servicios->random($count_items) : ["servicio" => $servicios];
            if ($count_items != 1) {
                foreach ($items as $item) {
                    $cantidad = $faker->numberBetween(1, 10);
                    $valor_unitario = $item->costo;
                    $copago = $faker->randomFloat(2, 0, ($valor_unitario * $cantidad));
                    $valor_total = ($valor_unitario * $cantidad) - $copago;
                    $orden_total += $valor_total;
                    OrdenServicio_Items::create([
                        'id_orden_servicio' => $orden->id,
                        'cups' => $item->id_servicio->cups,
                        'descripcion' => $item->id_servicio->descripcion,
                        'cantidad' => $cantidad,
                        'copago' => $copago,
                        'valor_unitario' => $valor_unitario,
                        'valor_total' => $valor_total,
                        'facturado' => 0
                    ]);
                }
            } else {
                $item = $items;
                $cantidad = $faker->numberBetween(1, 10);
                $valor_unitario = $item->costo;
                $copago = $faker->randomFloat(2, 0, ($valor_unitario * $cantidad));
                $valor_total = ($valor_unitario * $cantidad) - $copago;
                $orden_total += $valor_total;
                OrdenServicio_Items::create([
                    'id_orden_servicio' => $orden->id,
                    'cups' => $item->id_servicio->cups,
                    'descripcion' => $item->id_servicio->descripcion,
                    'cantidad' => $cantidad,
                    'copago' => $copago,
                    'valor_unitario' => $valor_unitario,
                    'valor_total' => $valor_total,
                    'facturado' => 0
                ]);
            }
            $orden->orden_total = $orden_total;
            $orden->save();

        }
    }
}
