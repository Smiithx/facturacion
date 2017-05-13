<?php

use Illuminate\Database\Seeder;

class ManualesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Manuales::class)->times(100)->create();
    }
}
