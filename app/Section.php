<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function telefones(){
		return $this->hasMany('App\Telefone');
	}
}
