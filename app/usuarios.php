<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    //
    public function perfil(){
        return $this->belongsTo('App\perfiles', 'id_perfil', 'id');
    }

    public function cuentas(){
        return $this->hasMany('App\cuentas', 'id_usuario', 'id');
    }

    public function transacciones(){
        return $this->hasMany('App\transacciones', 'id_usuario', 'id');
    }
}
