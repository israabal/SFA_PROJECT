<?php

namespace App\Policies;

use App\Models\SubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->hasPermissionTo('Read-SubCategories')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ',403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user,SubCategory $SubCategory)
    {
        return $user->hasPermissionTo('Read-SubCategories')
        ? $this->allow()
        : $this->deny('Don\'t have Permission ', 403);

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( $user)
    {
        return $user->hasPermissionTo('Create-SubCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission ', 403);
}

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( $user, SubCategory $SubCategory)
    {
        return $user->hasPermissionTo('Update-SubCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission ', 403);
}



    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( $user, SubCategory $SubCategory)
    {
        return $user->hasPermissionTo('Delete-SubCategory')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }


    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(SubCategory $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\SubCategory  $SubCategory
     * @param  \App\Models\SubCategory  $SubCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(SubCategory $user)
    {
        //
    }
}
