<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perfiles extends Model
{
    //
    public function permisos(){
        return $this->belongsToMany('App\usuarios','usuarios_perfiles','fk_usuario','fk_perfil')->withPivot('estado', 'fk_perfil', 'fk_usuario');
    }
}
