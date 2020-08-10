<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the owning imageable model.
     */
    public function detailable()
    {
        return $this->morphTo();
    }

   

}
