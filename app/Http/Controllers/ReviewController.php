<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Http\Requests\ReviewFormRequest;
use Database\Factories\ReviewFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * 新規レビュー作成フォームを返す
     */
    public function add()
    {
        return view('auth.review.create');
    }

    /**
     * 新規レビューを作成
     * @param \App\Http\Requests\ReviewFormRequest $request
     * @return 
     */
    public function create(ReviewFormRequest $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $session = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($session);

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

            return view('auth.review.done');
        }
    }
}