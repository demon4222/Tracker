<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProjectUser extends Model
{
    protected $fillable = ['project_id', 'user_id', 'role'];
    protected $table = 'project_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
