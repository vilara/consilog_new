<?php

namespace App\Policies;

use App\Comando;
use App\Om;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {

        $comando = Comando::where('codomOm', $user->detail->om->codom)->get();
       // dd($comando[0]->oms);
        $om = Om::where('id', $user->detail->om->id)->with('comandos')->get();
        
        if($user->can('update')){
   
            if($comando->isNotEmpty()){ // usuários de comandos
            return $comando[0]->oms->contains('codom', $model->detail->om->codom) // retorna os usuários das OMS
            || 
            $user->detail->om->codom === $model->detail->om->codom // retorna os usuários da mesma OM
            ;
            }
            //usuários de OM normais sem ser comando
            return $user->detail->om->codom === $model->detail->om->codom; // retorna todos da mesma OM
        }else{
            return $user->id === $model->id; // retorna todos só o usuário logado
        }
       
      
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
