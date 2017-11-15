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
Route::get('/profile', 'Auth\ProfileController@index')->name('profile.index');
Route::post('/profile', 'Auth\ProfileController@store')->name('profile.store');
Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/about','AboutController@index')->name('about.index');
Route::post('/about','AboutController@send_mail')->name('about.sendmail');
Route::get('/mail-success','AboutController@mail_success')->name('about.mailsuccess');

Route::resource('artist','ArtistController');
Route::get('artist/{count?}/{page?}','ArtistController@index')->name('artist.page');
Route::resource('person','PersonController');
Route::get('person/{count?}/{page?}','PersonController@index')->name('person.page');
Route::resource('song','SongController');
Route::get('song/{count?}/{page?}','SongController@index')->name('song.page');
Route::resource('mediumtypes','MediumTypesController');

// this is for the search form only
Route::group(['prefix' => 'search', 'as' => 'search-'], function() {
    // Route to show the form
    Route::get('{subject?}','SearchController@index')->name('form');
    
    // Route to show the results
    Route::get('{subject?}/{search?}','SearchController@search')->name('search');
});

// Routes for the search engine (select2 and opensearch)
Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete-'], function() {
    Route::get('opensearch/{subject}/{search}', 'AutocompleteController@opensearch')->name('opensearch');
    Route::get('select2/artist/{search}','AutocompleteController@select2artist')->name('select2artist');
    Route::get('select2/person/{search}','AutocompleteController@select2person')->name('select2person');
});
