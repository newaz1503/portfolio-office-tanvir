<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Inquiry;
use App\Models\Admin;

class InquiryPolicy
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
     * @param  \App\Models\Inquiry  $inquiry
     * @return mixed
     */
    public function view(Admin $admin, Inquiry $inquiry)
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
     * @param  \App\Models\Inquiry  $inquiry
     * @return mixed
     */
    public function update(Admin $admin, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Inquiry  $inquiry
     * @return mixed
     */
    public function delete(Admin $admin, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Inquiry  $inquiry
     * @return mixed
     */
    public function restore(Admin $admin, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Inquiry  $inquiry
     * @return mixed
     */
    public function forceDelete(Admin $admin, Inquiry $inquiry)
    {
        //
    }
}
