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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('dashboard', "DashboardController@index")->name('dashboard');
$router->group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/attributes', 'AttributesController@index')->name('attributes');
    Route::get('/matches', 'MatchController@index')->name('matches');
    Route::get('/campbell', 'MatchController@profile')->name('campbell');
    Route::post('/attributes', 'AttributesController@store')->name('store_attributes');
});

$router->group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::post('/attributes/suburbs}', 'AttributesController@suburbs');

});
