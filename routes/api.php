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

Route::group(['prefix' => '', 'as' => 'api-'], function() {
    Route::group(['prefix' => 'autocomplete', 'as' => 'autocomplete-'], function() {
        Route::post('raw/person','AutocompleteController@rawperson')->name('rawperson');
        Route::post('raw/artist','AutocompleteController@rawartist')->name('rawartist');
    });
    
    Route::group(['prefix' => 'v1', 'as' => 'v1-'], function() {
        Route::resource('artist','Api\v1\ArtistController');
        Route::resource('person','Api\v1\PersonController');
        Route::resource('song','Api\v1\SongController');
    });
});