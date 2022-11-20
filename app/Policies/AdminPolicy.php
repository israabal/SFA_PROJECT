<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->hasPermissionTo('Read-Admins')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ',403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user,Admin $admin)
    {
        return $user->hasPermissionTo('Read-Admins')
        ? $this->allow()
        : $this->deny('Don\'t have Permission ', 403);

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( $user)
    {
        return $user->hasPermissionTo('Create-Admin')
        ? $this->allow()
        : $this->deny('Don\'t have Permission ', 403);
}

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( $user,Admin $admin)
    {
        return $user->hasPermissionTo('Update-Admin')
        ? $this->allow()
        : $this->deny('Don\'t have Permission ', 403);
}



    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( $user,Admin $admin)
    {
        return $user->hasPermissionTo('Delete-Admin')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }


    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $user)
    {
        //
    }
}
