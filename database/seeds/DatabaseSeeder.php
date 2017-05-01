<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Cie10;
use App\Medicamentos;
use App\Servicios;
use App\Paciente;
use App\Aseguradora;
use App\Empresa;
use App\ordenservicios;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unreguard();
        /*Cie10::truncate();
        $this->call('Cie10Seeder');
        Medicamentos::truncate();
        $this->call('MedicamentosSeeder');
        Servicios::truncate();
        $this->call('ServiciosSeeder');
*/
        Aseguradora::truncate();
        $this->call('AseguradoraSeeder');
        Paciente::truncate();
        $this->call('PacientesSeeder');
        $this->call('EmpresaSeeder');
        $this->call('DiagnosticosSeeder');
        ordenservicios::truncate();
        $this->call('OrdendeserviciosSeeder');
        //Model::reguard();


    }
}
