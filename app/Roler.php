<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roler extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_roler', 'roler_id', 'permission_id');
    }
}
