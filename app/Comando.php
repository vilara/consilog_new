<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comando extends Model
{
    public function oms(){
    	return $this->belongsToMany('App\Om', 'comando_om', 'comando_id', 'om_id')->orderBy('om_id')->withPivot('omds');
    }

        /**
     * Many to Many
     */
    public function omdsCmdo()
    {
    	return $this->belongsToMany('App\Om', 'comando_om', 'comando_id', 'om_id' )->orderBy('om_id')->wherePivot('omds', 1);
    }
    
    public function getOmdsId(){

   $omds = $this->oms;
   foreach ($omds as $om) {
    $t[] = $om->id;
}

       return   $t;
    }



    
    public $timestamps = false;
}
