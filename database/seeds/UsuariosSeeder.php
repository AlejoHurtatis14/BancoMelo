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
        //
        DB::table('usuarios')->insert([
            'nombres' => 'Administrador',
            'apellidos' => 'Apellido',
            'telefono' => '3333333',
            'correo' => 'n@n.com',
            'usuario' => 'admin',
            'password' => '1',
            'nro_documento' => '12345',
            'estado' => 1,
            'usuario_creador' => 1,
            'fk_perfil' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
