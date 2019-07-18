<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['project_id', 'parent_id', 'creator_id', 'assigned_to_id', 'name', 'description', 'type_id', 'state_id', 'priority_id', 'estimation', 'spent_time'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
