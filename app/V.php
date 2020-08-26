<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class V extends Model
{
    /**
     * Get the dateils's military.
     */
    public function material()
    {
        return $this->morphOne('App\Material', 'materialable');
    }

    protected $table = 'v';
}
