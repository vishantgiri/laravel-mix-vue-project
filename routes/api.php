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


// upload
Route::post('upload', 'UsersDetailsController@upload');

// List articles
Route::get('usersdetails', 'UsersDetailsController@index');

// List single article
Route::get('usersdetail/{id}', 'UsersDetailsController@show');

// Create new article
Route::post('usersdetail', 'UsersDetailsController@store');

// Update article
Route::put('usersdetail', 'UsersDetailsController@store');

// Delete article
Route::delete('usersdetail/{id}', 'UsersDetailsController@destroy');


