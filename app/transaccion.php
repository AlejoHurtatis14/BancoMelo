<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaccion extends Model
{
    //
    public function usuario(){
        return $this->belongsTo('App\tipo_transaccion', 'fk_tipo_transaccion');
    }
}
