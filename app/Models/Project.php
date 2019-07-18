<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function projectUser()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function isUserNotInProject($userId)
    {
        return $this->projectUser()->whereUserId($userId)->get()->isEmpty();
    }
}
