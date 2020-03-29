<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuentas extends Model
{
    //
    public function usuario(){
        return $this->belongsTo('App\usuarios', 'id_usuario', 'id');
    }

    public function transacciones(){
        return $this->hasMany('App\transacciones', 'id_cuenta', 'id');
    }
}
