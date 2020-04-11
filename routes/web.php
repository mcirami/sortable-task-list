<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web'], function() {
    Route::get('/tasks', 'TasksController@show');
    Route::post('/tasks/store', 'TasksController@store');
    Route::post('/tasks/edit', 'TasksController@edit');
    Route::post('/tasks/update', 'TasksController@update');
    Route::post('/tasks/delete', 'TasksController@destroy');
});
