<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transacciones extends Model
{
    //
    public function usuario(){
        return $this->belongsTo('App\usuarios', 'id_usuario', 'id');
    }

    public function cuenta(){
        return $this->belongsTo('App\cuentas', 'id_cuenta', 'id');
    }
}
