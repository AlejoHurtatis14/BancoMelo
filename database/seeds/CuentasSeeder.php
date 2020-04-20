<?php

use Illuminate\Database\Seeder;

class CuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cuentas')->insert([
            'nombre' => 'Cuenta casa',
            'saldo' => '10000',
            'password' => '123',
            'estado' => 1,
            'fk_tipo_cuenta' => 1,
            'fk_usuario' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
