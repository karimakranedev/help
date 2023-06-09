<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Access\Authorizable;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the authorizable can view any models.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function viewAny(Authorizable $authorizable):Response|bool
    {
        return $authorizable->can('view_any_user');
    }

    /**
     * Determine whether the authorizable can view the model.
     *
     * @param Authorizable $authorizable
     * @param  User $user
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function view(Authorizable $authorizable, User $user):Response|bool
    {
        return $authorizable->can('view_user');
    }

    /**
     * Determine whether the authorizable can create models.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException

     */
    public function create(Authorizable $authorizable):Response|bool
    {
        return $authorizable->can('create_user');
    }

    /**
     * Determine whether the Authorizable can update the model.
     *
     * @param Authorizable $authorizable
     * @param  User $user
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function update(Authorizable $authorizable, User $user):Response|bool
    {
        return $authorizable->can('update_user');
    }

    /**
     * Determine whether the Authorizable  can delete the model.
     *
     * @param Authorizable $authorizable
     * @param  User  $user
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function delete(Authorizable $authorizable, User $user):Response|bool
    {
        return $authorizable->can('delete_user');
    }

    /**
     * Determine whether the Authorizable can bulk delete.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function deleteAny(Authorizable $authorizable):Response|bool
    {
        return $authorizable->can('delete_any_user');
    }

    /**
     * Determine whether the Authorizable can permanently delete.
     *
     * @param Authorizable $authorizable
     * @param  User  $user
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function forceDelete(Authorizable $authorizable, User $user):Response|bool
    {
        return $authorizable->can('force_delete_user');
    }

    /**
     * Determine whether the Authorizable can permanently bulk delete.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function forceDeleteAny(Authorizable $authorizable):Response|bool
    {
        return $authorizable->can('force_delete_any_user');
    }

    /**
     * Determine whether the Authorizable can restore.
     *
     * @param Authorizable $authorizable
     * @param  User  $user
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function restore(Authorizable $authorizable, User $user):Response|bool
    {
        return $authorizable->can('restore_user');
    }

    /**
     * Determine whether the Authorizable can bulk restore.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function restoreAny(Authorizable $authorizable):Response|bool
    {
        return $authorizable->can('restore_any_user');
    }

    /**
     * Determine whether the Authorizable can replicate.
     *
     * @param Authorizable $authorizable
     * @param  User  $user
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function replicate(Authorizable $authorizable, User $user):Response|bool
    {
        return $authorizable->can('replicate_user');
    }

    /**
     * Determine whether the Authorizable can reorder.
     *
     * @param Authorizable $authorizable
     * @return Response|bool
     * @throws AuthorizationException
     */
    public function reorder(Authorizable $authorizable):Response|bool
    {
        return $authorizable->can('reorder_user');
    }

}
