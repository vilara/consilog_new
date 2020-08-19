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

class Telefone extends Model
{
     /**
     * Get the owning commentable model.
     */
    public function telefoneable()
    {
        return $this->morphTo();
    }

    public function section()
	{
		return $this->belongsTo('App\Section', 'section_id');
	}
	
	public function tipoTel()
	{
		return $this->belongsTo('App\TipoTel', 'tipo_tel_id');
	}
}
