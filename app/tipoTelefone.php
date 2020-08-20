<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoTelefone extends Model
{
    public function telefones(){
		return $this->hasMany('App\Telefone','tipotelefone_id', 'id');
	}
}
