<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_transaccion extends Model
{
    //
    public function transacciones(){
        return $this->hasMany('App\transaccion', 'fk_tipo_transaccion', 'id');
    }
}
