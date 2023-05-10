<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param Admin $admin
     * @return Response|bool
     */
    public function viewAny(Admin $admin):Response|bool
    {
        return $admin->can('view_any_shield::role');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param Admin $admin
     * @param Role $role
     * @return Response|bool
     */
    public function view(Admin $admin, Role $role):Response|bool
    {
        return $admin->can('view_shield::role');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param Admin $admin
     * @return Response|bool
     */
    public function create(Admin $admin):Response|bool
    {
        return $admin->can('create_shield::role');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param Admin $admin
     * @param Role $role
     * @return Response|bool
     */
    public function update(Admin $admin, Role $role):Response|bool
    {
        return $admin->can('update_shield::role');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param Admin $admin
     * @param Role $role
     * @return Response|bool
     */
    public function delete(Admin $admin, Role $role):Response|bool
    {
        return $admin->can('delete_shield::role');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param Admin $admin
     * @return Response|bool
     */
    public function deleteAny(Admin $admin):Response|bool
    {
        return $admin->can('delete_any_shield::role');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param Admin $admin
     * @param Role $role
     * @return Response|bool
     */
    public function forceDelete(Admin $admin, Role $role):Response|bool
    {
        return $admin->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param Admin $admin
     * @return Response|bool
     */
    public function forceDeleteAny(Admin $admin):Response|bool
    {
        return $admin->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param Admin $admin
     * @param Role $role
     * @return Response|bool
     */
    public function restore(Admin $admin, Role $role):Response|bool
    {
        return $admin->can('{{ Restore }}');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param Admin $admin
     * @return Response|bool
     */
    public function restoreAny(Admin $admin):Response|bool
    {
        return $admin->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param Admin $admin
     * @param Role $role
     * @return Response|bool
     */
    public function replicate(Admin $admin, Role $role):Response|bool
    {
        return $admin->can('{{ Replicate }}');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param Admin $admin
     * @return Response|bool
     */
    public function reorder(Admin $admin):Response|bool
    {
        return $admin->can('{{ Reorder }}');
    }

}
