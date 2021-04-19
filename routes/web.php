<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;

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
  Route::get('/signup', [UserController::class, 'add'])->name('add');
  Route::post('/users/create', [UserController::class, 'create'])->name('create');
});


Route::middleware(['auth'])->group(function() {
  Route::get('/', [HomeController::class, 'index'])->name('top');
  Route::get('/users/edit', [UserController::class, 'edit'])->name('edit');
  Route::patch('/users/update', [UserController::class, 'update'])->name('update');
  
  Route::get('/reviews/add', [ReviewController::class, 'add']);
  Route::post('/reviews/create', [ReviewController::class, 'create']);
  Route::delete('/reviews/delete', [ReviewController::class, 'delete']);
  
  Route::post('/follow', [FollowController::class, 'followReview']);
  Route::delete('/follow/delete', [FollowController::class, 'unFollowReview']);

  Route::post('/like', [LikeController::class, 'like']);
  Route::delete('/like/delete', [LikeController::class, 'unLike']);

  Route::get('/password/edit', [ChangePasswordController::class, 'showChangePasswordView']);
  Route::patch('/password', [ChangePasswordController::class, 'changePassword']);
});

require __DIR__.'/auth.php';