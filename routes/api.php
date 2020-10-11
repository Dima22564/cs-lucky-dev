<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/user', 'UserController@index');

Route::get('/auth/steam', 'AuthController@redirectToSteam')->name('auth.steam');
Route::get('/auth/steam/handle', 'AuthController@handle')->name('auth.steam.handle');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::post('/change-items', 'ItemController@change');

Route::get('/exchange-items', 'ItemController@index');

// TODO Change routes with prefix /game
Route::post('/make-bet', 'GameController@makeBet');
Route::post('/auto-take', 'GameController@autoTake');

Route::group(
  ['prefix' => '/game'],
  function () {
    Route::post('/get', 'GameController@getGame');
    Route::post('/multiplier', 'GameController@setMultiplier');
    Route::post('/crash-bets', 'GameController@crashBets');
    Route::post('/take-bet', 'GameController@takeBet');
    Route::get('/{id}', 'GameController@index');
  });

Route::get('/inventory', 'UserController@inventory')->middleware(IsAuth::class);
Route::get('/all', 'AllController');
