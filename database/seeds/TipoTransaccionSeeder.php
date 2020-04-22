<?php

use Illuminate\Database\Seeder;

class TipoTransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = ['Transferencia', 'Retiro', 'Consignación'];
        for ($i=0; $i < 3 ; $i++) { 
            DB::table('tipo_transacciones')->insert([
                'nombre' => $tipos[$i],
                'estado' => 1,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }
    }
}
