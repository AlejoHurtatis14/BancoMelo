<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PerfilesSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(CuentasSeeder::class);
        $this->call(TipoTransaccionSeeder::class);
        $this->call(CodigoSolicitudSeeder::class);
        $this->call(TransaccionSeeder::class);
    }
}
