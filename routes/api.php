<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/points/{team_id}','TeamController@pointDetails'); //ajax  //will be changed later
Route::get('/player/{id}','PlayersController@playerdetails'); //ajax
Route::get('/team/{id}','TeamController@teamdetails');  //ajax