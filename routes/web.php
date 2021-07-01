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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/joueur/{slug}', 'PlayerController@index')->name('show-player');
Route::get('/equipe', 'TeamController@index')->name('show-team');

Route::get('/storeall/mmr', 'MmrController@storeAllMMR')->name('store-all-mmr');

Route::get('/get/mvpprofile', 'PlayerController@getMvpProfile')->name('get-mvp-profile');

Route::get('/storeall/games/{btnrefresh?}', 'TeamgameController@findTeamGames')->name('store-all-games');


//Dropzone
Route::post('/game/videoupload','VideoController@videoUpload')->name('videoUpload');