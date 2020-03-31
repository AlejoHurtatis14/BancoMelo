<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuentas extends Model
{
    //
    public function usuario(){
        return $this->belongsTo('App\usuarios', 'fk_usuario');
    }

    public function transacciones(){
        return $this->hasMany('App\transaccion', 'fk_cuenta', 'id');
    }

    public function codigosSolicitud(){
        return $this->hasMany('App\codigo_solicitud', 'fk_cuenta', 'id');
    }
}
