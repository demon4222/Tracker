<?php

namespace App\Observers;

use App\Models\Task;
use App\Notifications\TaskAdded;
use App\Notifications\TaskAssigned;
use App\Notifications\TaskDeleted;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCreatedMail;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->project->users->each(function ($user) use ($task){
            $user->notify(new TaskAdded($task));
        });
        $task->assigned->notify(new TaskAssigned($task));
    }

    /**
     * Handle the task "updated" event.
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function updated(Task $task)
    {
        //
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $task->assigned->notify(new TaskDeleted());
    }

    /**
     * Handle the task "restored" event.
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
