<?php

use App\Events\CommentSent;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Models\Review;

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
Route::middleware(['guest'])->group(function() {
  Route::get('/signup', [UserController::class, 'add'])->name('signup');
  Route::post('/users/create', [UserController::class, 'create']);
  Route::get('/', [HomeController::class, 'index'])->name('top');
});


Route::middleware(['auth'])->group(function() {
  
  Route::get('/users', [UserController::class, 'index'])->name('mypage');
  Route::get('/users/edit', [UserController::class, 'edit'])->name('user-edit');
  Route::patch('/users/update', [UserController::class, 'update'])->name('user-update');
  Route::delete('/users/delete', [UserController::class, 'delete']);

  Route::get('/reviews', [ReviewController::class, 'index']);
  Route::get('/reviews/add', [ReviewController::class, 'add']);
  Route::post('/reviews/create', [ReviewController::class, 'create']);
  Route::delete('/reviews/delete', [ReviewController::class, 'delete']);
  
  Route::get('/school', [HomeController::class, 'showSchool'])->name('school');
  
  Route::get('/rankings', [HomeController::class, 'showRankings'])->name('ranking');
  
  Route::post('/follow', [FollowController::class, 'followReview']);
  Route::delete('/follow/delete', [FollowController::class, 'unFollowReview']);

  Route::post('/like', [LikeController::class, 'like']);
  Route::delete('/like/delete', [LikeController::class, 'unLike']);

  Route::get('/password/change', [ChangePasswordController::class, 'showChangePasswordView']);
  Route::patch('/password', [ChangePasswordController::class, 'changePassword']);

  Route::get('/email/edit', [ChangeEmailController::class, 'showChangeEmailForm']);
  Route::post('/email', [ChangeEmailController::class, 'sendChangeEmailLink'])->name('email');
  Route::post('/email/reset', [ChangeEmailController::class, 'reset']);
});

require __DIR__.'/auth.php';