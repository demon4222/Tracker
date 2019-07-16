<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $fillable = ['project_id', 'user_id', 'role'];
    protected $table = 'project_user';
}
