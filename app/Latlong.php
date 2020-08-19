<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Latlong extends Model
{
    public function endereco()
	{
		return $this->belongsTo('App\Endereco');
	}
}
