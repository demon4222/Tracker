<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SYS_ADMIN = 1;
    const PROJECT_ADMIN = 2;
    const DEVELOPER = 3;
}
