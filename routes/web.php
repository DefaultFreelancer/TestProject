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

// Front routers
Route::get('/','FrontController@index')->name('index');

// Auth routers
Auth::routes();

// User routers
Route::prefix('/user')->namespace('Auth')->group(function (){
    Route::get('/', 'UserController@index')->name('user');
    Route::post('/{id}', 'UserController@update')->name('user.update');
});

// Dashboard routers
Route::prefix('dashboard/')->group(function (){
    Route::get('/','MainController@index')->name('dashboard');
    Route::get('/calendar','MainController@calendar')->name('dashboard.calendar');
});

