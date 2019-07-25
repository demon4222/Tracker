<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = ['text', 'task_id', 'user_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
