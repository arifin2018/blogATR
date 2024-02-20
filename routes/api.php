<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/','UserController@index');
Route::get('/{id}','UserController@findById');
Route::post('/','UserController@create')->name('create');
Route::post('/createBook','UserController@createBook');
Route::put('/{id}','UserController@update')->name('updateBook');
Route::delete('/{id}','UserController@destroy')->name('destroyBook');
