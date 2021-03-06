<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\Message;
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
    return Message::all();
    });
    
Route::middleware('api')->post('/reviews/message', function() {
    $message = Message::create(['user_id' => Auth::id(), 'review_id' => request()->reviewId, 'message' => request()->message]);

    event((new MessageSent($message))->dontBroadcastToCurrentUser());

    return $message;
});