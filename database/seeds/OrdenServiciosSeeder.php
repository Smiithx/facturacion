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
        $servicios = Servicios::where("estado", "=", "Activo")->get();
        foreach ($ordenes_de_servicios as $orden) {
            $items = $faker->numberBetween(1, 10);
            for ($i = 1; $i <= $items; $i++) {
                $pos = $faker->numberBetween(0, count($servicios));
                $cantidad = $faker->numberBetween(0, 10);
                $copago = $faker->randomFloat(2);
                $valor_unitario = $faker->randomFloat(2);
                $valor_total = ($valor_unitario * $cantidad) - $copago;
                OrdenServicio_Items::create([
                    'id_orden_servicio' => $orden->id,
                    'cups' => $servicios[$pos]->cups,
                    'descripcion' => $servicios[$pos]->descripcion,
                    'cantidad' => $cantidad,
                    'copago' => $copago,
                    'valor_unitario' => $valor_unitario,
                    'valor_total' => $valor_total
                ]);
            }
        }
    }
}
