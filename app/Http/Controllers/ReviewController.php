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
        dump('hoge');
        return view('auth.review.create');
    }

    /**
     * 新規レビューを作成
     * @param \App\Http\Requests\ReviewFormRequest $request
     * @return view | RedirectResponse
     */
    public function create(ReviewFormRequest $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);

        //リクエストの中身に受け付けないフィールドが含まれるか調べる
        $correctFields = [
            'school_id', 'course_id', 'purpose', 'result', 'language', 'title', 'tuition',
            'term', 'curriculum', 'mentor', 'support', 'staff', 'judgment', 'report',
        ];

        $requestFields = $request->all();
        $exceptFields = Arr::except($requestFields, $correctFields);

        if (Auth::id() !== $sessionId) {

            return redirect(403);

        } elseif (empty($exceptFields) === false) {
            
            return redirect(403);

        } else {

            $requestFields['user_id'] = $sessionId;
            Review::create($requestFields);

            return view('auth.review.review');
        }
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

        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);
        
        //ユーザーの指定したレビューをユーザーが持っているか確認
        if (Review::find($reviewId)->user_id !== $sessionId) {
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