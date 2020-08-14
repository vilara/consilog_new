<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comando extends Model
{
    public function oms(){
    	return $this->belongsToMany('App\Om', 'comando_om', 'comando_id', 'om_id')->orderBy('om_id')->withPivot('omds');
    }

    public $timestamps = false;
}
