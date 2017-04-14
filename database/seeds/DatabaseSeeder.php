<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Cie10;
use App\Medicamentos;
use App\Procedimientos;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cie10::truncate();
        $this->call('Cie10Seeder');
        Medicamentos::truncate();
        $this->call('MedicamentosSeeder');
        Procedimientos::truncate();
        $this->call('ProcedimientosSeeder');
        //Model::reguard();
    }
}
