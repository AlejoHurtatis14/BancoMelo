<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perfiles extends Model
{
    //
    public function usuarios(){
    /* return $this->belongsToMany('App\usuarios','usuarios_perfiles','fk_usuario','fk_perfil')->withPivot('estado', 'fk_perfil', 'fk_usuario'); */
    return $this->hasMany('App\usuarios', 'fk_perfil', 'id');
    }
}
