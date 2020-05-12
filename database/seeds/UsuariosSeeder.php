<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $nombres = ['Raul', 'Sofia', 'Juan Felipe', 'Orlando'];
        $apellidos = ['Jimenez', 'Tamayo', 'Arenas', 'Florez'];
        $telefono = ['32423432', '5345345', '3454355', '234234'];
        $correos = ['r@r.com', 's@s.com', 'j@j.com', 'o@0.com'];
        $documento = ['12345', '67890', '09876', '54321'];
        $perfil = [1, 2, 2, 2];

        for ($i=0; $i < 4 ; $i++) {
            $fecha = $i + 1;
            DB::table('usuarios')->insert([
                'nombres' => $nombres[$i],
                'apellidos' => $apellidos[$i],
                'telefono' => $telefono[$i],
                'correo' => $correos[$i],
                'usuario' => Str::lower($nombres[$i]),
                'password' => $i . '',
                'nro_documento' => $documento[$i],
                'estado' => 1,
                'usuario_creador' => 1,
                'fk_perfil' => $perfil[$i],
                'created_at' => date('2020-0' . ($fecha + 2) . '-0' . ($fecha + 2) . ' H:m:s'),
                'updated_at' => date('2020-' . ($fecha + 2) . '-0' . ($fecha + 2) . ' H:m:s'),
            ]);
        }

        DB::table('usuarios')->insert([
            'nombres' => 'Usuario',
            'apellidos' => 'Apellido',
            'telefono' => '78697798',
            'correo' => 'u@u.com',
            'usuario' => 'user',
            'password' => '10',
            'nro_documento' => '43533',
            'estado' => 1,
            'usuario_creador' => 1,
            'fk_perfil' => 2,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);

    }
}