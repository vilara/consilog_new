<?php

namespace App\Policies;

use App\Comando;
use App\Http\Controllers\UserController;
use App\Om;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OmPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Om  $om
     * @return mixed
     */
    public function view(User $user, Om $om)
    {

        $c = new UserController;
        $comando = Comando::where('codomOm', $user->detail->om->codom)->first();
        if ($c->isUserGCmdo($user)) { // se o  usuario autenticado for pertecente a comando
        return $comando->oms->contains('codom', $om->codom); // visualiza os usuários das omds
        }else{
            return $user->detail->om->id === $om->id;
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
     * @param  \App\Om  $om
     * @return mixed
     */
    public function update(User $user, Om $om)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Om  $om
     * @return mixed
     */
    public function delete(User $user, Om $om)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Om  $om
     * @return mixed
     */
    public function restore(User $user, Om $om)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Om  $om
     * @return mixed
     */
    public function forceDelete(User $user, Om $om)
    {
        //
    }
}
