<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Om extends Model
{
    /**
     * Get the users for the om.
     */
    public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
