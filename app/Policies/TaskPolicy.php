<?php

namespace App\Policies;

use App\Models\Project;
use App\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    protected function isProjectAdmin(User $user, Task $task)
    {
        $role = $this->getRole($user, $task);
        if (!$role) {
            return false;
        }
        return $role->role == User::ROLE_PROJECT_ADMIN;
    }

    protected function getRole(User $user, Task $task)
    {
        return $task->project->projectUser()->whereUserId($user->id)->first();
    }

    /**
     * Determine whether the user can view any tasks.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param \App\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user, Project $project)
    {
        $role = $project->projectUser()->whereUserId($user->id)->first();

        if (!$role) {
            return false;
        }

        return $role->role == User::ROLE_PROJECT_ADMIN;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param \App\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return $this->isProjectAdmin($user, $task);
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param \App\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return $this->isProjectAdmin($user, $task);
    }

    /**
     * Determine whether the user can restore the task.
     *
     * @param \App\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function restore(User $user, Task $task)
    {
        return $this->isProjectAdmin($user, $task);
    }

    /**
     * Determine whether the user can permanently delete the task.
     *
     * @param \App\User $user
     * @param \App\Models\Task $task
     * @return mixed
     */
    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
