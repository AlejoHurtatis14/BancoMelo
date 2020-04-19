<?php

use Illuminate\Database\Seeder;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfiles')->insert([
            'nombre' => "Administrador",
            'estado' => 1,
            'usuario_creador' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('perfiles')->insert([
        'nombre' => "Usuarios",
            'estado' => 1,
            'usuario_creador' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

/*         DB::table('usuarios_perfiles')->insert([
            'fk_usuario' => 1,
            'fk_perfil' => 1,
            'estado' => 1,
            'fk_usuario_creador' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
          ]); */
    }
}
