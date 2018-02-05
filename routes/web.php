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

Auth::routes();
Route::get('/profile', 'Auth\ProfileController@index')->name('profile.index');
Route::post('/profile', 'Auth\ProfileController@store')->name('profile.store');
Route::get('/likes', 'Auth\ProfileController@likes')->name('profile.likes');
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/about','AboutController@index')->name('about.index');
Route::post('/about','AboutController@send_mail')->name('about.sendmail');
Route::get('/mail-success','AboutController@mail_success')->name('about.mailsuccess');
Route::get('/api','AboutController@api')->name('about.api');

Route::resource('artist','ArtistController');
Route::get('artist/{count?}/{page?}','ArtistController@index')->name('artist.page');
Route::resource('person','PersonController');
Route::get('person/{count?}/{page?}','PersonController@index')->name('person.page');
Route::resource('song','SongController');
Route::get('song/create/{artist}','SongController@createwithartist')->name('song.createwithartist');
Route::get('song/{song}/sync','SongController@sync')->name('song.sync');
Route::put('song/{song}/sync','SongController@sync_store')->name('song.syncstore');
Route::get('song/{count?}/{page?}','SongController@index')->name('song.page');
Route::resource('mediumtypes','MediumTypesController');

// Routes for the search engine (select2 and opensearch)
Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete-'], function() {
    Route::get('opensearch/{subject}/{search}', 'AutocompleteController@opensearch')->name('opensearch');
    Route::get('select2/artist/{search}','AutocompleteController@select2artist')->name('select2artist');
    Route::get('select2/person/{search}','AutocompleteController@select2person')->name('select2person');
});

Route::get('test/{param1}/{param2}', 'TestController@ArrayParameters');
Route::get('test/auth', 'TestController@authorized_test');

Route::group(['prefix' => 'subject', 'as' => 'subject.'], function() {
    Route::post('{subject}/like','SubjectController@like')->middleware('auth')->name('like');
});

Route::group(['prefix' => 'sitemap', 'as' => 'sitemap-'], function() {
    Route::get('', 'SitemapController@all')->name('all');
    Route::get('artist/{start}/{end}', 'SitemapController@artist_chunk')->name('artist.chunk');
    Route::get('person/{start}/{end}', 'SitemapController@person_chunk')->name('person.chunk');
    Route::get('song/{start}/{end}', 'SitemapController@song_chunk')->name('song.chunk');
});