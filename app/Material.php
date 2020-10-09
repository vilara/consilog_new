<?php

namespace App;

use Illuminate\Support\Collection;
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

     /**
     * Get the comments for the blog post.
     */
    public function materialomtotal()
    {
        return $this->hasOne('App\material_om_total');
    }

    public function GetTotOmCod(Collection $om){

        $municao = $this->materialable;
        $muntot = V::where('codigo', $municao->codigo)->get();
        $t = 0;
        foreach ($muntot as $mun) {
          $t +=  $mun->material->oms->whereIn('id', $om)->sum('pivot.qtde');
        }
        return $t;
    }

    public function GetTotOmCodValidate(Collection $om, $validade){

        $municao = $this->materialable;
        $muntot = V::where('codigo', $municao->codigo)->get();
        $t = 0;
        foreach ($muntot as $mun) {
          $t +=  $mun->material->oms->whereIn('id', $om)->where('pivot.validade', $validade)->sum('pivot.qtde');
        }
        return $t;
    }

    public function GetTotOmCodValidateMenorQue(Collection $om, $validade){

        $municao = $this->materialable;
        $muntot = V::where('codigo', $municao->codigo)->get();
        $t = 0;
        foreach ($muntot as $mun) {
          $t +=  $mun->material->oms->whereIn('id', $om)->where('pivot.validade','<=', $validade)->sum('pivot.qtde');
        }
        return $t;
    }

    public function GetMinValCod(Collection $om){

         $municao = $this->materialable;
         $muntot = V::where('codigo', $municao->codigo)->get();
         $t = collect([]);
        foreach ($muntot as $mun) {
          $t->push($mun->material->oms->whereIn('id', $om)->min('pivot.validade')) ;
        }
        return $t->filter()->min();
    }



   
}
