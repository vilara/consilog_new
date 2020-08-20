<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo extends Model
{
    public function telefones(){
		return $this->hasMany('App\Telefone','tipo_id', 'id');
	}
}
