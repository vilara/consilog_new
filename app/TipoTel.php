<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTel extends Model
{
    public function telefones(){
		return $this->hasMany('App\Telefone');
	}
}
