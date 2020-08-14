<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }

       /**
     * Many to Many
     */
    public function comandos()
    {
    	return $this->belongsToMany('App\Comando', 'comando_om', 'om_id', 'comando_id' )->withPivot('omds');
    }

    public $timestamps = false;
}
