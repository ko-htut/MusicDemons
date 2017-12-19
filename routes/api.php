<?php

use Illuminate\Http\Request;
use Laravel\Passport\Passport;

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

Route::group(['prefix' => '', 'as' => 'api-'], function() {
    Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete-'], function() {
        Route::post('raw/person','AutocompleteController@rawperson')->name('rawperson');
        Route::post('raw/artist','AutocompleteController@rawartist')->name('rawartist');
    });
    
    Route::group(['prefix' => 'v1', 'as' => 'v1-'], function() {
        Route::group(['prefix' => 'artist', 'as' => 'artist.'], function() {
            Route::get('','Api\v1\ArtistController@index')->name('index');
            Route::get('{artist}','Api\v1\ArtistController@show')->name('show');
            Route::post('','Api\v1\ArtistController@store')->middleware('auth:api')->name('store');
            Route::put('{artist}','Api\v1\ArtistController@update')->middleware('auth:api')->name('update');
            Route::delete('{artist}','Api\v1\ArtistController@destroy')->middleware('auth:api')->name('destroy');
            Route::post('datatables','Api\v1\ArtistController@datatables')->name('datatables');
        });
        Route::group(['prefix' => 'person', 'as' => 'person.'], function() {
            Route::get('','Api\v1\PersonController@index')->name('index');
            Route::get('{person}','Api\v1\PersonController@show')->name('show');
            Route::post('','Api\v1\PersonController@store')->middleware('auth:api')->name('store');
            Route::put('{person}','Api\v1\PersonController@update')->middleware('auth:api')->name('update');
            Route::delete('{person}','Api\v1\PersonController@destroy')->middleware('auth:api')->name('destroy');
            Route::post('datatables','Api\v1\PersonController@datatables')->name('datatables');
        });
        Route::group(['prefix' => 'song', 'as' => 'song.'], function() {
            Route::get('','Api\v1\SongController@index')->name('index');
            Route::get('{song}','Api\v1\SongController@show')->name('show');
            Route::post('','Api\v1\SongController@store')->middleware('auth:api')->name('store');
            Route::put('{song}','Api\v1\SongController@update')->middleware('auth:api')->name('update');
            Route::delete('{song}','Api\v1\SongController@destroy')->name('destroy');
            Route::post('datatables','Api\v1\SongController@datatables')->name('datatables');
        });
    });
});