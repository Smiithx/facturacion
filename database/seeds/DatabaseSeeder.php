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
use App\OrdenServicio_Items;
use App\Factura;
use App\FacturaItems;
use App\Diagnosticos;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       // Model::unreguard();
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \App\Contratos::truncate();
        \App\Manuales::truncate();
        Servicios::truncate();
        Cie10::truncate();
        Medicamentos::truncate();
        FacturaItems::truncate();
        Factura::truncate();
        OrdenServicio_Items::truncate();
        ordenservicios::truncate();
        Paciente::truncate();
        Aseguradora::truncate();
        Diagnosticos::truncate();
        Empresa::truncate();

        $this->call('Cie10Seeder');
        $this->call('MedicamentosSeeder');
        $this->call('ServiciosSeeder');
        $this->call('AseguradoraSeeder');
        $this->call('PacientesSeeder');
        $this->call('EmpresaSeeder');
        $this->call('DiagnosticosSeeder');
        $this->call('OrdenServiciosSeeder');

        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Model::reguard();
    }
}
