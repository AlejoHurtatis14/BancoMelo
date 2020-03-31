<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codigo_solicitud extends Model
{
    //
    public function cuentas(){
        return $this->belongsTo('App\cuentas', 'fk_cuenta');
    }
}
