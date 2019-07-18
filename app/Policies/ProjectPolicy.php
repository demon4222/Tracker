<?php

namespace App\Policies;

use App\Models\ProjectUser;
use App\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if($user->is_admin) {
            return true;
        }
    }

    protected function isProjectAdmin(User $user, Project $project)
    {
        $role =  $this->getRole($user, $project);

        return $role == User::ROLE_PROJECT_ADMIN;
    }

    protected function getRole(User $user, Project $project)
    {
        return $project->projectUser()->whereUserId($user->id);
    }

    /**
     * Determine whether the user can view any projects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function update(Project $project, User $user)
    {
        return $this->isProjectAdmin($user, $project);
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return false;
    }

    public function addUser(Project $project, User $user)
    {
        return $this->isProjectAdmin($user, $project);
    }

    public function removeUser(Project $project, User $user)
    {
        return $this->isProjectAdmin($user, $project);
    }

    public function changeUserRole(Project $project, User $user)
    {
        return $this->isProjectAdmin($user, $project);
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }
}
