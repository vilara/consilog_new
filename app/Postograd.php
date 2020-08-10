<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postograd extends Model
{
    public function military(){
		return $this->hasMany('App\Military');
	}

    public function details()
    {
        return $this->hasManyThrough(
            'App\Detail',
            'App\Military',
            'postograd_id', // Foreign key on militaries table...
            'detailable_id', // Foreign key on details table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }

  

   
}
