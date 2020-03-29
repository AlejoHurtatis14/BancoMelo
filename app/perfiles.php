<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perfiles extends Model
{
    //
    public function usuarios(){
        return $this->hasMany('App\usuarios', 'id_perfil', 'id');
    }
}
