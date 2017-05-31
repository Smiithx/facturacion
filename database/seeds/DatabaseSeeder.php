<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
use App\User;
use App\Glosas;
use App\Manuales;

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
        \App\Manuales_servicios::truncate();
        Medicamentos::truncate();
        OrdenServicio_Items::truncate();
        ordenservicios::truncate();
        Paciente::truncate();
        Aseguradora::truncate();
        Diagnosticos::truncate();
        Empresa::truncate();
        FacturaItems::truncate();
        Factura::truncate();
        User::truncate();
         \App\Glosas::truncate();

        $this->call('MedicamentosSeeder');
        $this->call('EmpresaSeeder');
        $this->call('DiagnosticosSeeder');
        $this->call('ServiciosSeeder');
        $this->call('AseguradoraSeeder');
        // manuales
        $this->call('ManualesServiciosSeeder');
        $this->call('ContratoSeeder');
        $this->call('PacientesSeeder');
        $this->call('OrdenServiciosSeeder');
        $this->call('ItemOrdenServicioSeeder');
        $this->call('FacturasSeeder');
        $this->call('GlosasSeeder');
        $this->call('UsuariosSeeder');
        // usuarios



        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Model::reguard();
    }
}
