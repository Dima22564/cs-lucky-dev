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
    return view('layouts.app');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/public-chat', 'ChatController@store');

Route::get('/get-public-chat', 'ChatController@index');

Route::get('/all', 'AllController');

Route::get('/game-prepare', 'GameController@prepare');

Route::post('/game-start', 'GameController@start');

Route::post('/make-bet', 'BetController@makeBet');

Route::get('auth/steam', 'AuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', 'AuthController@handle')->name('auth.steam.handle');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('user', 'UserController@index');