<?php

namespace App\Policies;

use App\Comando;
use App\Http\Controllers\UserController;
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
        $c = new UserController;
        $model = User::find(3);
        $comando = Comando::where('codomOm', $user->detail->om->codom)->first();

        if ($c->isUserGCmdo($user)) { // se o  usuario autenticado for pertecente a comando
            if($user->can('update')){ // se o usuario autenticado pertence a comando e é gerente (update)
              return $user->detail->om->codom == $model->detail->om->codom || // visualiza os usuarios da mesma Om ou 
              $comando->omdsCmdo->contains('codom', $c->gCmdoDiretamenteEnqdUser($model)->codomOm); // visualiza os usuários das omds
            }else{
                return $user->id == $model->id; // visualiza somente o usuáiro logado
            }
        }else{
            return $user->id == $model->id; // visualiza somente o usuáiro logado
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
