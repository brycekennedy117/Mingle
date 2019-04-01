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
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile',[
    'middleware' => 'auth',
    'uses' => 'UserController@profile'
]);

Route::get('edit-profile',[
    'middleware' => 'auth',
    'uses' => 'UserController@edit-profile'
]);


Route::post('/profile/change-password','UserController@changePassword')->name('changePassword');
