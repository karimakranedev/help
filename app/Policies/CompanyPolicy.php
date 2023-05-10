<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Authorizable;



class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the authorizable can view any models.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function viewAny(Authorizable $authorizable): Response|bool
    {
        return $authorizable->can('view_any_company');
    }

    /**
     * Determine whether the authorizable can view the model.
     *
     * @param Authorizable $authorizable
     * @param Company $company
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function view(Authorizable $authorizable, Company $company): Response|bool
    {
        return $authorizable->can('view_company');
    }

    /**
     * Determine whether the authorizable can create models.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function create(Authorizable $authorizable): Response|bool
    {
        return $authorizable->can('create_company');
    }

    /**
     * Determine whether the authorizable can update the model.
     *
     * @param Authorizable $authorizable
     * @param Company $company
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function update(Authorizable $authorizable, Company $company): Response|bool
    {
        return $authorizable->can('update_company');
    }

    /**
     * Determine whether the authorizable can delete the model.
     *
     * @param Authorizable $authorizable
     * @param Company $company
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function delete(Authorizable $authorizable, Company $company): Response|bool
    {
        return $authorizable->can('delete_company');
    }

    /**
     * Determine whether the authorizable can bulk delete.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function deleteAny(Authorizable $authorizable): Response|bool
    {
        return $authorizable->can('delete_any_company');
    }

    /**
     * Determine whether the authorizable can permanently delete.
     *
     * @param Authorizable $authorizable
     * @param Company $company
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function forceDelete(Authorizable $authorizable, Company $company): Response|bool
    {
        return $authorizable->can('force_delete_company');
    }

    /**
     * Determine whether the authorizable can permanently bulk delete.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function forceDeleteAny(Authorizable $authorizable): Response|bool
    {
        return $authorizable->can('force_delete_any_company');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param Authorizable $authorizable
     * @param Company $company
     * @return Response|bool
     */
    public function restore(Authorizable $authorizable, Company $company): Response|bool
    {
        return $authorizable->can('restore_company');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     */
    public function restoreAny(Authorizable $authorizable): Response|bool
    {
        return $authorizable->can('restore_any_company');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param Authorizable $authorizable
     * @param  Company  $company
     * @return Response|bool
     */
    public function replicate(Authorizable $authorizable, Company $company): Response|bool
    {
        return $authorizable->can('replicate_company');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     */
    public function reorder(Authorizable $authorizable): Response|bool
    {
        return $authorizable->can('reorder_company');
    }

}
