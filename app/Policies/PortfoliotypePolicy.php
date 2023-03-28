<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Portfoliotype;
use App\Models\Admin;

class PortfoliotypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Portfoliotype  $portfoliotype
     * @return mixed
     */
    public function view(Admin $admin, Portfoliotype $portfoliotype)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Portfoliotype  $portfoliotype
     * @return mixed
     */
    public function update(Admin $admin, Portfoliotype $portfoliotype)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Portfoliotype  $portfoliotype
     * @return mixed
     */
    public function delete(Admin $admin, Portfoliotype $portfoliotype)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Portfoliotype  $portfoliotype
     * @return mixed
     */
    public function restore(Admin $admin, Portfoliotype $portfoliotype)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Portfoliotype  $portfoliotype
     * @return mixed
     */
    public function forceDelete(Admin $admin, Portfoliotype $portfoliotype)
    {
        //
    }
}
