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

Route::get( '/user', function ( Request $request ) {
    return $request->user();
} )->middleware( 'api' );

Route::get( '/topic', function ( Request $request ) {

    return \App\Topic::select( [ 'name', 'id' ] )->where( 'name', 'like', "%{$request->query('q')}%" )->get();
} )->middleware( 'api' );
