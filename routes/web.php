<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::resource('/projects', 'ProjectController', [
            'except' => ['show', 'edit', 'update']
        ]);

        Route::get('/', 'AdminController@index');

        Route::resource('/states', 'StateController', [
           'except' => ['create', 'show']
        ]);

        Route::resource('/priorities', 'PriorityController', [
            'except' => ['create', 'show']
        ]);

        Route::resource('/types', 'TypeController', [
            'except' => ['create', 'show']
        ]);
    });
    Route::group(['namespace' => 'User'], function () {
        Route::resource('/projects', 'ProjectController', [
            'except' => ['create', 'destroy', 'index', 'store']
        ]);

        Route::get('/myprojects', 'ProjectController@index');

        Route::group(['prefix' => 'projects/{project}'], function(){
            Route::delete('/removeUser/{userId}', 'ProjectController@removeUserFromProject');
            Route::get('/addUser/{userId}', 'ProjectController@addUser');
            Route::post('/changeUserRole/{userId}', 'ProjectController@changeUserRole');
            Route::get('/members', 'ProjectController@members');

            Route::resource('/tasks', 'TaskController');

            Route::post('/tasks/search', 'TaskController@search');
        });
        Route::post('/tasks/{task}/changeType', 'TaskController@changeType');
        Route::post('/tasks/{task}/changeState', 'TaskController@changeState');
        Route::post('/tasks/{task}/changePriority', 'TaskController@changePriority');
        Route::post('/tasks/{task}/changeAssigned', 'TaskController@changeAssigned');

        Route::post('/tasks/{task}/addComment', 'CommentController@store');
        Route::delete('/comments/{comment}/delete', 'CommentController@destroy');
        Route::put('/comments/{comment}/update', 'CommentController@update');
    });
});
