<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
    protected $fillable = ['project_id', 'parent_id', 'creator_id', 'assigned_to_id', 'name', 'description', 'type_id', 'state_id', 'priority_id', 'estimation', 'spent_time'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
