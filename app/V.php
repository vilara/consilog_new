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

     /**
     * The om that belong to the irtaexefetivo.
     */
    public function irtaexoiis()
    {
        return $this->belongsToMany('App\IrtaexOii','irtaexeoii_v', 'v_id', 'irtaexoii_id')->withPivot('quantidade');;
    }

    protected $table = 'v';
}
