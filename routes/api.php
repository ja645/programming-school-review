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

Route::middleware('api')->get('/reviews', function() {
    return \App\Models\Message::all();
});

Route::middleware('api')->post('/reviews/message', function() {
    $message = \App\Models\Message::create(['user_id' => 1, 'review_id' => 2, 'message' => request()->message]);

    return $message;
});