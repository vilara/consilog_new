<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   public function rolers(){
        return $this->belongsToMany('\App\Roler');
    }
}
