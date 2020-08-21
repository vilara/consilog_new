<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function detail()
    {
        return $this->hasOne('App\Detail', 'user_id', )->with('detailable');
    }

    // public function om()
    // {
    //     return $this->hasManyThrough(
    //         'App\Detail',
    //         'App\Om',
           
    //     );
    // }

    public function cargo()
    {
    	return $this->belongsTo('App\Cargp');
    }

    public function rolers()
    {
        return $this->belongsToMany('App\Roler', 'roler_user', 'user_id', 'roler_id');
    }

    public function hasPermission(Permission $permission){

        return $this->hasAnyRolers($permission->rolers);
    }

    public function hasAnyRolers($rols){

            foreach ($rols as $rol){
                if($this->rolers->contains('name', $rol->name)){
                    return true;
                }
            }


    }

}
