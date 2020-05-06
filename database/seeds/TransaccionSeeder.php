<?php

use Illuminate\Database\Seeder;

class TransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaccions')->insert([
            'monto' => 5000,
            'saldo_anterior' => 10000,
            'saldo_Actual' => 5000,
            'fk_usuario_creador' => 1,
            'fk_cuenta' => 1,
            'fk_codigo' => 1,
            'fk_tipo_transaccion' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
