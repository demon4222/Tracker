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

Route::group(['middleware'=>'auth'], function(){
    Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function (){
        Route::resource('/projects', 'ProjectController');
        Route::delete('/projects/{project}/removeUser/{userId}', 'ProjectController@removeUserFromProject');
        Route::get('/projects/{project}/addUser/{userId}', 'ProjectController@addUser');
        Route::post('/projects/{project}/changeUserRole/{userId}', 'ProjectController@changeUserRole');
        Route::get('/projects/{project}/members', 'ProjectController@members');
    });
});
