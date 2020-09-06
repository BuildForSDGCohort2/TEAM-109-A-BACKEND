<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(["middleware" => 'trusted_host'], function () {
    
    Route::group(['prefix'=> 'v1'], function () {
        Route::prefix('users')->group(function() {
            Route::post('/create', 'UserController@store');
            Route::post('/signin', 'UserController@signInUser');
            Route::post('signout', 'UserController@signOutUser')->middleware('auth');

        });
    });

    //All Route Groups that requires Authentication should go here
    Route::group(['middleware' => 'jwt', 'prefix' => 'v1'], function () {
        Route::prefix('users')->group(function() {
            Route::get('/all', 'UserController@getUsers');
            Route::get('/countries', 'CountryController@getCountries');
            Route::get('/{country}/states', 'StateController@getStates');
            Route::get('/{state}/lgas', 'LgaController@getLgas');
        });
    });

});