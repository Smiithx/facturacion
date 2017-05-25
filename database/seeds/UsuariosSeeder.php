<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->times(14)->create();
        \App\user::create([
            'name' => "Administrador",
            'email' => "admin@facturacion.com",
            'password' => bcrypt("admin"),
            'remember_token' => str_random(10),
        ]);
    }
}
