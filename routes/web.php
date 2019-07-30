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
Route::get('/tasks/{id}', 'PagesController@show');
Route::get('/tasks/{id}/edit', 'PagesController@edit');
Route::patch('/tasks/{id}', 'PagesController@update');
Route::delete('/tasks/{id}', 'PagesController@destroy');

*/


Route::get('/', 'HomeController@index');
Route::get('/about', 'PagesController@about');

Route::resource('tasks', 'TasksController');
Route::resource('projects', 'ProjectsController');

Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
Route::post('/projects/{project}/tasks','ProjectTasksController@store');

Auth::routes();
