<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IrtaexEfetivo extends Model
{

    public function postograd()
	{
		return $this->belongsTo('App\Postograd', 'postograd_id', 'id');
    }
    
    public function irtaexcategory()
	{
		return $this->belongsTo('App\irtaexCategory', 'irtaexcategory_id', 'id');
    }

    /**
     * The om that belong to the irtaexefetivo.
     */
    public function oms()
    {
        return $this->belongsToMany('App\Om','irtaexefetivo_om', 'irtaexefetivo_id', 'om_id')->withPivot('efetivo');;
    }

    /**
     * The om that belong to the irtaexefetivo.
     */
    public function irtaexoiis()
    {
        return $this->belongsToMany('App\IrtaexOii','irtaexefetivo_irtaexoii', 'irtaexefetivo_id', 'irtaexoii_id')->withPivot('tipo');;
    }
    
    protected $table = 'irtaexefetivos';
}
