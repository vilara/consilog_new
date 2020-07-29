<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    /**
     * Get the users for the Cargo.
     */
    public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
