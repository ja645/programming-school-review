<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SchoolController;
use App\Models\Review;
use App\Events\MessageSent;
use App\Events\CommentSent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('top');

Route::get('/signup', [UserController::class, 'add'])->name('signup');
Route::post('/users/create', [UserController::class, 'create']);

Route::get('/contacts', [HomeController::class, 'showContactForm']);
Route::post('/contacts', [HomeController::class, 'receiveContact']);


Route::middleware(['auth'])->group(function() {
  Route::get('/users', [UserController::class, 'index'])->name('mypage');
  Route::get('/users/edit', [UserController::class, 'edit'])->name('user-edit');
  Route::post('/users/update', [UserController::class, 'update'])->name('user-update');
  Route::delete('/users/delete', [UserController::class, 'delete']);

  Route::get('/reviews/school/{school_id}', [ReviewController::class, 'showList']);
  Route::get('/reviews/review/{id}', [ReviewController::class, 'showReview']);
  Route::get('/reviews', [ReviewController::class, 'add']);
  Route::post('/reviews/create', [ReviewController::class, 'create']);
  Route::delete('/reviews/delete', [ReviewController::class, 'delete']);


  // Route::get('/reviews', function() {
  //   return \App\Models\Message::all();
  // });

  // Route::post('/reviews/message', function() {
  //   $message = \App\Models\Message::create(['user_id' => Auth::id(), 'review_id' => request()->reviewId, 'message' => request()->message]);
    
  //   event((new MessageSent($message))->dontBroadcastToCurrentUser());

  //   return $message;
  // });

  
  Route::get('/schools/{id}', [SchoolController::class, 'showSchool'])->name('school');
  
  Route::get('/rankings', [RankingController::class, 'index'])->name('ranking');
  // Route::post('/rankings', [RankingController::class, 'showRanking']);
  
  // Route::get('/follow/{id}', [FollowController::class, 'getCurrentStatus']);
  // Route::post('/follow', [FollowController::class, 'switchFollow']);
  
  // Route::get('/like/{id}', [LikeController::class, 'current']);
  // Route::post('/like', [LikeController::class, 'switchLike']);

  Route::get('/password/change', [ChangePasswordController::class, 'showChangePasswordView']);
  Route::post('/password', [ChangePasswordController::class, 'changePassword']);

  Route::get('/email/edit', [ChangeEmailController::class, 'showChangeEmailForm']);
  Route::post('/email', [ChangeEmailController::class, 'sendChangeEmailLink'])->name('email');
  Route::post('/email/reset', [ChangeEmailController::class, 'reset']);
});
