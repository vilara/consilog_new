<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class irtaexCategory extends Model
{

    public function irtaexefetivo(){
		return $this->hasMany('App\IrtaexEfetivo','irtaexcategory_id');
	}

    protected $table = 'irtaexcategories';
}
