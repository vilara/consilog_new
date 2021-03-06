<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Military extends Model
{
    /**
     * Get the dateils's military.
     */
    public function detail()
    {
        return $this->morphOne('App\Detail', 'detailable');
    }

    public function postograd()
	{
		return $this->belongsTo('App\Postograd', 'postograd_id', 'id');
	}
}
