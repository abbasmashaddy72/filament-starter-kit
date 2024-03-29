<?php

namespace App\Policies;

use App\Models\User;
use Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic;
use Illuminate\Auth\Access\HandlesAuthorization;

class RouteStatisticPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic  $routeStatistic
     * @return bool
     */
    public function view(User $user, RouteStatistic $routeStatistic): bool
    {
        return $user->can('view_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic  $routeStatistic
     * @return bool
     */
    public function update(User $user, RouteStatistic $routeStatistic): bool
    {
        return $user->can('update_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic  $routeStatistic
     * @return bool
     */
    public function delete(User $user, RouteStatistic $routeStatistic): bool
    {
        return $user->can('delete_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic  $routeStatistic
     * @return bool
     */
    public function forceDelete(User $user, RouteStatistic $routeStatistic): bool
    {
        return $user->can('force_delete_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic  $routeStatistic
     * @return bool
     */
    public function restore(User $user, RouteStatistic $routeStatistic): bool
    {
        return $user->can('restore_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic  $routeStatistic
     * @return bool
     */
    public function replicate(User $user, RouteStatistic $routeStatistic): bool
    {
        return $user->can('replicate_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_::Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic');
    }

}
