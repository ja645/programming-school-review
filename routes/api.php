<?php

use App\Repositories\ReviewRepository;
use App\Events\MessageSent;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
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

// Route::middleware('api')->get('/reviews', function() {
//     return \App\Models\Message::all();
// });

// Route::middleware('api')->post('/reviews/message', function() {
//     $message = \App\Models\Message::create(['user_id' => 2, 'review_id' => 4, 'message' => request()->message]);

//     event((new MessageSent($message))->dontBroadcastToCurrentUser());

//     return $message;
// });


// Route::middleware('api')->post('/rankings', function() {
//     logger(request()->columnName);
//     $school = app(ReviewRepository::class)->getSchoolList(request()->columnName);
//     // 昇順にソート
//     // asort($school);
//     return $school;
// });

// Route::middleware('api')->post('/like', [LikeController::class, 'switchLike']);