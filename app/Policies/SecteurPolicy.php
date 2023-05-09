<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Secteur;
use Illuminate\Auth\Access\HandlesAuthorization;

class SecteurPolicy
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
        return $admin->can('view_any_secteur');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Secteur $secteur)
    {
        return $admin->can('view_secteur');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->can('create_secteur');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Secteur $secteur)
    {
        return $admin->can('update_secteur');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Secteur $secteur)
    {
        return $admin->can('delete_secteur');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(Admin $admin)
    {
        return $admin->can('delete_any_secteur');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Secteur $secteur)
    {
        return $admin->can('force_delete_secteur');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(Admin $admin)
    {
        return $admin->can('force_delete_any_secteur');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Secteur $secteur)
    {
        return $admin->can('restore_secteur');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(Admin $admin)
    {
        return $admin->can('restore_any_secteur');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(Admin $admin, Secteur $secteur)
    {
        return $admin->can('replicate_secteur');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(Admin $admin)
    {
        return $admin->can('reorder_secteur');
    }

}
