<?php

use Illuminate\Database\Seeder;

class CodigoSolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codigo_solicituds')->insert([
            'saldo' => '5000',
            'codigo' => '893748',
            'estado' => 1,
            'fk_cuenta' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
