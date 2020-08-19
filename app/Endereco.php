<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
* Usado para definir o type de dentro da tabela a ser morphitizada
*/
Relation::morphMap ( [ 
       
    'om' => 'App\Om',
    'usuario' => 'App\User' 

] );

class Endereco extends Model
{
      /**
     * Get the owning commentable model.
     */
    public function enderecoable()
    {
        return $this->morphTo();
    }

    public function latlong()
	{
		return $this->hasOne('App\Latlong');
	}
}
