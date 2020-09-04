<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Usado para definir o type de dentro da tabela a ser morphitizada
 */
Relation::morphMap([
		
		'v'=> 'App\V',
		'va'=> 'App\Va'
		
]);

class Material extends Model
{


   /**
     * Get the owning imageable model.
     */
    public function materialable()
    {
        return $this->morphTo();
    }

    /**
     * The om that belong to the material.
     */
    public function oms()
    {
        return $this->belongsToMany('App\Om','material_om', 'material_id', 'om_id')->withPivot('patrimonio','inclusao','validade','qtde','sit');
    }

}
