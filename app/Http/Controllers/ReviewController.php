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
    public function showList(int $school_id)
    {
        $reviews = Review::where('school_id', $school_id)->paginate(10);

        return view('auth.review.review-list', ['reviews' => $reviews]);
    }

    /**
     * 指定したユーザーのレビューを表示
     * @param integer $id
     * @return view
     */
    public function showReview(int $id)
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
        
        $requestFields['user_id'] = $user_id;
        $review = Review::create($requestFields);
    
        return redirect('/reviews/review/' . $review->id);
    }

    
    /**
     * レビューを削除
     * 
     * @param \Illuminate\Http\Request $request
     * @return view | RedirectResponse
     */
    public function delete(Request $request)
    {
        //リクエストからレビューのidを取得
        $review_id = $request->id;

        Review::find($review_id)->delete();

        return redirect(route('user.review'));
    }
}