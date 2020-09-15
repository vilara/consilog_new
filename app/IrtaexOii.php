<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IrtaexOii extends Model
{

    protected $fillable = ['oii', 'tarefa', 'condicao', 'padraminimo', 'irtaexcategory_id'];

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
    public function vs()
    {
        return $this->belongsToMany('App\V','irtaexeoii_v', 'irtaexoii_id', 'v_id')->withPivot('quantidade');;
	}
	
	/**
     * The om that belong to the irtaexefetivo.
     */
    public function irtaexefetivos()
    {
        return $this->belongsToMany('App\IrtaexEfetivo','irtaexefetivo_irtaexoii', 'irtaexoii_id', 'irtaexefetivo_id')->withTimestamps()->withPivot('tipo');;
    }

    public $timestamps = false;

    protected $table = 'irtaexoiis';
}
