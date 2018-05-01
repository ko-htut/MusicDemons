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
Route::get('/about', 'AboutController@index')->name('about.index');
Route::post('/about', 'AboutController@send_mail')->name('about.sendmail');
Route::get('/mail-success', 'AboutController@mail_success')->name('about.mailsuccess');
Route::get('/api', 'AboutController@api')->name('about.api');
Route::get('/robots.txt', 'RobotsController@robots')->name('robots');

Route::resource('artist','ArtistController');
Route::get('artist/{artist}/{name}','ArtistController@show_name')->name('artist.show_name');
Route::get('artist/{artist}/{name}/edit','ArtistController@edit_name')->name('artist.edit_name');
Route::get('artist/all/{count?}/{page?}','ArtistController@index')->name('artist.page');

Route::resource('person','PersonController');
Route::get('person/{person}/{name}','PersonController@show_name')->name('person.show_name');
Route::get('person/{person}/{name}/edit','PersonController@edit_name')->name('person.edit_name');
Route::get('person/all/{count?}/{page?}','PersonController@index')->name('person.page');

Route::resource('song','SongController');
Route::get('song/create/{artist}','SongController@createwithartist')->name('song.createwithartist');
Route::get('song/{song}/sync','SongController@sync')->name('song.sync');
Route::put('song/{song}/sync','SongController@sync_store')->name('song.syncstore');
Route::get('song/all/{count?}/{page?}','SongController@index')->name('song.page');
Route::get('song/{song}/{name}','SongController@show_name')->name('song.show_name');

Route::resource('mediumtypes','MediumTypesController');

// Routes for the search engine (select2 and opensearch)
Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete-'], function() {
    Route::get('opensearch/{subject}/{search}', 'AutocompleteController@opensearch')->name('opensearch');
    Route::get('select2/artist/{search}','AutocompleteController@select2artist')->name('select2artist');
    Route::get('select2/person/{search}','AutocompleteController@select2person')->name('select2person');
});

// Routes for the search form
Route::group(['prefix' => 'search', 'as' => 'search.'], function() {
    Route::get('{subject?}/{search_term?}','SearchController@index')->name('index');
    Route::post('','SearchController@redirect_params')->name('results');
});

Route::group(['prefix' => '', 'as' => 'opensearch-'], function() {
    Route::get('opensearch.xml', 'SearchController@opensearch_description');
    
    // route to redirect a search action to either the search form or the subject detail page (if one result)
    Route::get('opensearch/redirect/{search_terms}','SearchController@redirect_opensearch_action')->name('redirect');
});


Route::group(['prefix' => 'subject', 'as' => 'subject.'], function() {
    Route::post('{subject}/like','SubjectController@like')->middleware('auth')->name('like');
});

Route::group(['prefix' => 'sitemap', 'as' => 'sitemap-'], function() {
    Route::get('', 'SitemapController@all')->name('all');
    Route::get('artist/{start}/{end}', 'SitemapController@artist_chunk')->name('artist.chunk');
    Route::get('person/{start}/{end}', 'SitemapController@person_chunk')->name('person.chunk');
    Route::get('song/{start}/{end}', 'SitemapController@song_chunk')->name('song.chunk');
});

Route::group(['prefix' => 'components', 'as' => 'components-'], function() {
    Route::get('autocomplete', 'AngularComponentController@autocomplete')->name('autocomplete');
});

//Route::domain('adres-autocomplete.pieterjan.pro')->group(['prefix' => 'addresses', 'as' => 'addresses-'], function() {
//    Route::get('place/{id}',function(){ return ""; });
//});