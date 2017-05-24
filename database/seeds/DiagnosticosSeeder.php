<?php

use Illuminate\Database\Seeder;
use App\Diagnosticos;

class DiagnosticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Diagnosticos::class)->times(15)->create();
    }
}
