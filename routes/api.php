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

Route::middleware('auth.basic')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('products/mine', 'MyProductsController@index')->middleware('auth.basic');
Route::post('products/mine', 'MyProductsController@store')->middleware('auth.basic');
Route::delete('products/mine/{id}', 'MyProductsController@destroy')->middleware('auth.basic');
Route::resource('products', 'ProductController')->middleware('auth.basic');
