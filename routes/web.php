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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','TeamController@index');
Route::get('/players','PlayersController@index');
Route::get('/players/{team_id}','PlayersController@teamLists')->name('players');
Route::get('/points/{team_id}','TeamController@pointDetails'); //will be changed later
Route::get('/points','TeamController@points');
Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    /*** TEAM SECTION */
    Route::get('/team/create','TeamController@create');
    Route::post('/team','TeamController@store')->name('team');
    /***** PLAYER SECTION  */
    Route::get('/player/create','PlayersController@create');
    Route::post('/players','PlayersController@store')->name('players');   
    /***** Result  */
    Route::get('/team/result','TeamController@result'); 
    Route::post('/team/result','TeamController@result')->name('result'); 
});