<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Review;
use App\Models\School;
use App\Models\User;
use App\Http\Requests\ReviewFormRequest;
use Database\Factories\ReviewFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class ReviewController extends Controller
{
    /**
     * スクールに紐付くレビューリストを表示
     * @param integer $school_id
     * @return view
     */
    public function showList($school_id)
    {
        $reviews = Review::where('school_id', $school_id)->paginate(10);

        return view('auth.review.review-list', ['reviews' => $reviews]);
    }

    /**
     * 指定したユーザーのレビューを表示
     * @param integer $id
     * @return view
     */
    public function showReview($id)
    {
        $review = Review::find($id);

        return view('auth.review.review', ['review' => $review]);
    }

    /**
     * 新規レビュー作成フォームを返す
     * @return view
     */
    public function add()
    {
        return view('auth.review.create');
    }

    /**
     * 新規レビューを作成
     * @param \App\Http\Requests\ReviewFormRequest $request
     * @return view | RedirectResponse
     */
    public function create(ReviewFormRequest $request)
    {
        $user_id = Auth::id();

        $requestFields = $request->all();

        var_dump($requestFields);
        
        $requestFields['user_id'] = $user_id;
        Review::create($requestFields);
    
        return view('auth.review.review');
    }

    
    /**
     * レビューを削除
     * @param \Illuminate\Http\Request $request
     * @return view | RedirectResponse
     */
    public function delete(Request $request)
    {
        //リクエストからレビューのidを取得
        $reviewId = $request->id;

        //ユーザーの指定したレビューをユーザーが持っているか確認
        if (Review::find($reviewId)->user_id !== Auth::id()) {
            return redirect(403);
        } else {
            Review::find($reviewId)->delete();

            return view('auth.review.review');
        }
        
    }

    /**
     * コメント欄にメッセージを送信
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->message
        ]);
        
        event(new MessageSent($user, $message));

        session()->flash('flash_message', 'メッセージを送りました！');
    }
}