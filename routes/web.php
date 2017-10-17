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
    return redirect('/home');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home.index');
Route::resource('artist','ArtistController');

Route::group(['prefix' => 'search', 'as' => 'search-'], function() {
    Route::get('/', 'SearchController@index')->name('all');
    Route::get('/artist', 'SearchController@artist')->name('artist');
    Route::get('/album','SearchController@album')->name('album');
    Route::get('/song','SearchController@song')->name('song');
    Route::get('/person','SearchController@person')->name('person');
    Route::post('/search','SearchController@search')->name('search');
});
