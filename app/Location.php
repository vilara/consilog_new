<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Get the om record associated with the location.
     */
    public function om()
    {
        return $this->hasOne('App\Om','om_id');
    }
}
