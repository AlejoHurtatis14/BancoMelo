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
        $nombres = ['Prueba', 'Cuentica', 'Esta es una cuenta', 'Ahorrando'];
        $pass = ['123', '321', '555', '999'];
        for ($i=0; $i < 4 ; $i++) {
            $fecha = $i + 1;
            DB::table('cuentas')->insert([
                'nombre' => $nombres[$i],
                'saldo' => 10000,
                'password' => $pass[$i],
                'estado' => 1,
                'fk_tipo_cuenta' => 'Ahorro',
                'fk_usuario' => $i + 1,
                'created_at' => date('2020-0' . ($fecha + 2) . '-0' . ($fecha + 2) . ' H:m:s'),
                'updated_at' => date('2020-' . ($fecha + 2) . '-0' . ($fecha + 2) . ' H:m:s'),
            ]);
        }
        DB::table('cuentas')->insert([
            'nombre' => 'Cuenta casa',
            'saldo' => 10000,
            'password' => '123',
            'estado' => 1,
            'fk_tipo_cuenta' => 'Ahorro',
            'fk_usuario' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
