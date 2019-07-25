<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Observers\CommentObserver;
use App\Observers\TaskObserver;
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
        Task::observe(TaskObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
