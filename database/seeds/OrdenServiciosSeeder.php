<?php

use Illuminate\Database\Seeder;
use App\ordenservicios;
use App\OrdenServicio_Items;
use App\Servicios;
use Faker\Factory as Faker;

class OrdenServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $ordenes_de_servicios = factory(ordenservicios::class)->times(20)->create();
        foreach ($ordenes_de_servicios as $orden) {
            $servicios = \App\Manuales_servicios::where("id_manual",$orden->id_contrato->id_manual)->where("estado","Activo")->get();
            $count_servicios = count($servicios);
            $count_items = $faker->numberBetween(1, ($count_servicios > 10 ? 10: $count_servicios));
            $orden_total = 0;
            $items = $servicios->random($count_items);
            foreach ($items as $item){
                $cantidad = $faker->numberBetween(1, 10);
                $valor_unitario = $item->costo;
                $copago = $faker->randomFloat(2,0,($valor_unitario * $cantidad));
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
