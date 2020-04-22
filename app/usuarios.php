<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//Añadimos la clase JWTSubject 
use Tymon\JWTAuth\Contracts\JWTSubject;

class usuarios extends Model
{
    //
    public function perfil(){
        /* return $this->belongsToMany('App\perfiles','usuarios_perfiles','fk_usuario','fk_perfil')->withPivot('estado', 'fk_perfil', 'fk_usuario'); */
        return $this->belongsTo('App\perfiles', 'fk_perfil');
    }

    public function cuentas(){
        return $this->hasMany('App\cuentas', 'id_usuario', 'id');
    }

    public function transacciones(){
        return $this->hasMany('App\transacciones', 'id_usuario', 'id');
    }

}
