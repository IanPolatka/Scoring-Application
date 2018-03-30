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

Route::get('/years', 'YearsController@apishowall');
Route::get('/years/{id}', 'YearsController@apishow');
Route::post('/years', 'YearsController@apistore');
Route::put('/years/{year}', 'YearsController@apiupdate');