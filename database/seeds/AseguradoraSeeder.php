<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Aseguradora;

class AseguradoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 1; $i <= 20; $i++){
            Aseguradora::create(['nombre' => $faker->company]);

           /* factory(Aseguradora::class)->time(20)->create();*/
        }
    }
}
