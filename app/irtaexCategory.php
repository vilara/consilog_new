<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class irtaexCategory extends Model
{

    protected $fillable = ['categoria', 'armamento'];

    public function irtaexefetivo(){
		return $this->hasMany('App\IrtaexEfetivo','irtaexcategory_id');
    }
    public $timestamps = false;

    protected $table = 'irtaexcategories';
}
