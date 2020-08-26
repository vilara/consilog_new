<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CustomCollection;

class Om extends Model
{

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomeOm', 'siglaOM', 'codom', 'codug'
    ];

    /**
     * Get the users for the om.
     */
    public function detail()
    {
        return $this->hasMany('App\detail', 'om_id');
    }

    // public function user()
    // {
    //     return $this->hasManyThrough(
    //         'App\User',
    //         'App\Detail',
    //         'om_id', // Foreign key on User table...
    //         'user_id', // Foreign key on details table...
    //         'id', // Local key on details table...
    //         'id' // Local key on users table...
    //     );
    // }

       /**
     * Many to Many
     * retorna todds os comandos 
     */
    public function comandos()
    {
    	return $this->belongsToMany('App\Comando', 'comando_om', 'om_id', 'comando_id' )->orderBy('comando_id')->withPivot('omds');
    }

       /**
     * Many to Many
     * Retorna o comando diretamente enquadrante
     */
    public function comandosOmds()
    {
    	return $this->belongsToMany('App\Comando', 'comando_om', 'om_id', 'comando_id' )->orderBy('comando_id')->wherePivot('omds', 1);
    }

     /**
     * The om that belong to the material.
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material','material_om', 'om_id', 'material_id')->withPivot('patrimonio','inclusao','validade','qtde','sit');
    }

    public function materialsTot()
    {
        return $this->belongsToMany('App\Material','material_om', 'om_id', 'material_id')->withPivot('patrimonio','inclusao','validade','qtde','sit');
    }



   

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    // public function newCollection(array $models = [])
    // {
    //     return new CustomCollection($models);
    // }

     /**
     * Get all of the om's telefones.
     */
    public function telefones()
    {
        return $this->morphMany('App\Telefone', 'telefoneable');
    }

     /**
     * Get all of the om's enderecos.
     */

    public function enderecos()
    {
        return $this->morphMany('App\Endereco', 'enderecoable');
    }


 
    
   

    public $timestamps = false;
}
