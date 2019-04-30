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
    Route::get('/matches', 'MatchController@matches')->name('matches');
    Route::get('/campbell', 'MatchController@profile')->name('campbell');
    Route::post('/attributes', 'AttributesController@store')->name('store_attributes');
    Route::post('/attributes/suburbs', 'AttributesController@suburbs');
    Route::get('matches/{profile}', 'MatchController@profile')->name('profile');
    Route::get('/profile', 'UserController@index')->name('profile');
//    test route
    Route::post('/like', 'DashboardController@liked')->name('like');
    Route::post('/dislike', 'DashboardController@dislike')->name('ignore');
    Route::get('/dashboard', 'DashboardController@viewMatches');
    Route::get('/editprofile', 'UserController@edit');
    Route::resource('messages', 'MessagesController');
    Route::get('/messages', 'MessagesController@index')->name('messages');
    Route::post('/messages', 'MessagesController@store')->name('send-message');
    Route::post('/messages/get', 'MessagesController@getMessages')->name('get-messages');
    Route::get('/', 'HomeController@index');
    Route::post('/editprofile', 'UserController@editpassword')->name('edit');
    Route::get('message/{id}/delete', ['uses' => 'MessagesController@delete', 'as' => 'message.delete']);


    Route::post('/profile', [
        'as' => 'avatar',
        'uses' => 'AttributesController@showAvatar'
    ]);
});

$router->group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
});
