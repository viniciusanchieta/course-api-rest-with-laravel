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

Route::get('/test', function(Request $request){

    $response = new \Illuminate\Http\Response(json_encode(['mgs' => 'Minha primeira resposta de API']));
    $response->header('Content-Type', 'application/json');

    return $response;
});

//Products Route
Route::prefix('products')->group(function () {
    Route::get('/', 'Api\ProductController@index');
    Route::get('/{id}', 'Api\ProductController@show');
    Route::post('/', 'Api\ProductController@save');
});
