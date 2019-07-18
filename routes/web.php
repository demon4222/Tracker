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
        Route::get('/states', 'AdminController@states');
        Route::post('/states/store', 'AdminController@stateStore');
        Route::delete('/states/{state}/destroy', 'AdminController@stateDestroy');
        Route::put('/states/{state}/update', 'AdminController@stateUpdate');
        Route::get('/states/{state}/edit', 'AdminController@stateEdit');

        Route::get('/priorities', 'AdminController@priorities');
        Route::post('/priorities/store', 'AdminController@priorityStore');
        Route::delete('/priorities/{priority}/destroy', 'AdminController@priorityDestroy');
        Route::put('/priorities/{priority}/update', 'AdminController@priorityUpdate');
        Route::get('/priorities/{priority}/edit', 'AdminController@priorityEdit');

        Route::get('/types', 'AdminController@types');
        Route::post('/types/store', 'AdminController@typeStore');
        Route::delete('/types/{type}/destroy', 'AdminController@typeDestroy');
        Route::put('/types/{type}/update', 'AdminController@typeUpdate');
        Route::get('/types/{type}/edit', 'AdminController@typeEdit');
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
