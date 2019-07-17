<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::directive('project_admin', function ($projectId) {
            dd($projectId);
            $role = ProjectUser::where(['project_id' => $projectId, 'user_id' => Auth()->user()->id])->first()->role;
            return $role == User::ROLE_PROJECT_ADMIN;
        });
    }
}
