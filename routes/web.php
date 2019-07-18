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
    });
    Route::group(['namespace' => 'User'], function () {
        Route::resource('/projects', 'ProjectController', [
            'except' => ['create', 'destroy', 'index', 'store']
        ]);
        Route::get('/myprojects', 'ProjectController@index');
        Route::delete('/projects/{project}/removeUser/{userId}', 'ProjectController@removeUserFromProject');
        Route::get('/projects/{project}/addUser/{userId}', 'ProjectController@addUser');
        Route::post('/projects/{project}/changeUserRole/{userId}', 'ProjectController@changeUserRole');
        Route::get('/projects/{project}/members', 'ProjectController@members');

        Route::get('/projects/{project}/tasks/create', 'TaskController@create');
        Route::post('/projects/{project}/tasks/store', 'TaskController@store');
    });
});
