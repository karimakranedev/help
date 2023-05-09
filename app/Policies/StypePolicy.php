<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Stype;
use Illuminate\Auth\Access\HandlesAuthorization;

class StypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->can('view_any_stype');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stype  $stype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Stype $stype)
    {
        return $admin->can('view_stype');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->can('create_stype');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stype  $stype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Stype $stype)
    {
        return $admin->can('update_stype');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stype  $stype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Stype $stype)
    {
        return $admin->can('delete_stype');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(Admin $admin)
    {
        return $admin->can('delete_any_stype');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stype  $stype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Stype $stype)
    {
        return $admin->can('force_delete_stype');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(Admin $admin)
    {
        return $admin->can('force_delete_any_stype');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stype  $stype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Stype $stype)
    {
        return $admin->can('restore_stype');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(Admin $admin)
    {
        return $admin->can('restore_any_stype');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Stype  $stype
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(Admin $admin, Stype $stype)
    {
        return $admin->can('replicate_stype');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(Admin $admin)
    {
        return $admin->can('reorder_stype');
    }

}
