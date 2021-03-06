<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\SchoolDataController;
use App\Models\User;
use App\Models\Review;
use App\Models\School;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [HomeController::class, 'index'])->name('top');

// アカウント作成
Route::get('/signup', [UserController::class, 'add'])->name('signup');
Route::post('/users/create', [UserController::class, 'create']);

// お問い合わせ
Route::get('/contacts', [HomeController::class, 'showContactForm'])->name('contact');
Route::post('/contacts', [HomeController::class, 'receiveContact']);

// 管理者としてログインする
Route::get('/admin/login', [AuthenticationController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthenticationController::class, 'login']);

// ログイン後に閲覧可能
Route::middleware(['auth'])->group(function() {

  Route::get('/users', [UserController::class, 'index'])->name('mypage');
  Route::get('/users/edit', [UserController::class, 'edit'])->name('user.edit');
  Route::post('/users/update', [UserController::class, 'update'])->name('user.update');
  Route::delete('/users/delete', [UserController::class, 'delete'])->name('user.delete');
  Route::get('/users/reviews', [UserController::class, 'showMyReview'])->name('user.review');
  Route::get('/users/followings', [UserController::class, 'showFollowingsList'])->name('user.followings');
  Route::get('/users/likes', [UserController::class, 'showLikesList'])->name('user.likes');

  Route::get('/email/edit', [ChangeEmailController::class, 'showChangeEmailForm'])->name('email.edit');
  Route::post('/email', [ChangeEmailController::class, 'sendChangeEmailLink'])->name('email');
  Route::get('/email/reset/{token}', [ChangeEmailController::class, 'reset']);
  
  Route::get('/reviews/school/{school_id}', [ReviewController::class, 'showList']);
  Route::get('/reviews/review/{id}', [ReviewController::class, 'showReview']);
  Route::get('/reviews/add', [ReviewController::class, 'add'])->name('review.add');
  Route::post('/reviews/create', [ReviewController::class, 'create']);
  Route::delete('/reviews/delete', [ReviewController::class, 'delete']);
  
  Route::get('/schools/{id}', [SchoolController::class, 'showSchool']);
  Route::get('/schools', [SchoolController::class, 'showSchoolList'])->name('school.list');
  Route::post('/schools/search', [SchoolController::class, 'search'])->name('search');

  Route::get('/rankings', [RankingController::class, 'index'])->name('ranking');
  Route::post('/rankings', [RankingController::class, 'showRanking']);
  
  Route::get('/follow/{id}', [FollowController::class, 'getCurrentStatus']);
  Route::post('/follow', [FollowController::class, 'switchFollow']);
  
  Route::get('/like/{id}', [LikeController::class, 'current']);
  Route::post('/like', [LikeController::class, 'switchLike']);

  Route::get('/message/{id}', function(int $id) {
    $messages = Message::where('review_id', $id)->with('user')->get();

    return $messages;
  });
    
  Route::post('/message/send', function() {
    $message = Message::create(['user_id' => Auth::id(), 'review_id' => request()->reviewId, 'message' => request()->message]);

    event((new MessageSent($message))->dontBroadcastToCurrentUser());

    return $message;
  });
});

Route::group(['middleware' => ['auth.admin']], function () {
  // 管理者としてスクールのデータを操作する
  Route::get('/admin', [SchoolDataController::class, 'showSchoolList'])->name('school-list');
  Route::get('/admin/add', [SchoolDataController::class, 'showAddSchool'])->name('admin.add');
  Route::post('/admin/create', [SchoolDataController::class, 'addSchool']);
  Route::post('/admin/edit', [SchoolDataController::class, 'showEditSchool']);
  Route::post('/admin/update', [SchoolDataController::class, 'updateSchool']);
  Route::post('/admin/delete', [SchoolDataController::class, 'deleteSchool']);
  Route::post('/admin/logout', [AuthenticationController::class, 'logout'])->name('admin.logout');
});

require __DIR__.'/auth.php';
