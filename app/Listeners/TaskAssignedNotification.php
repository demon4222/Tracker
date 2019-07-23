<?php

namespace App\Listeners;

use App\Events\TaskAssignedChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TaskAssigned;

class TaskAssignedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskAssignedChanged  $event
     * @return void
     */
    public function handle(TaskAssignedChanged $event)
    {
        $task = $event->task;
        $task->project->assigned->notify(new TaskAssigned($task));
    }
}
