<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Following;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * 他のユーザーのレビューをフォロー
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function followReview(Request $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);

        //フォローするレビューのidを取得
        $followedReviewId = $request->followed_review_id;

        //レビューを投稿したユーザーのidを取得
        $posterId = Review::where('id', $followedReviewId)->select('user_id')->get()->toArray()[0]['user_id'];

        //そのレビューが存在するか
        // $reviewExists = Review::where('id', $followedReviewId)->exists();


        //現在のユーザーが過去に評価したレビューを取得
        // $reviewOnceFollowed = Following::where('follower_user_id', $sessionId)->select('followed_review_id')->get()->toArray();

        // if (Review::where('id', $followedReviewId)->exists() === false) {
        //     //存在しないレビューはフォロー出来ない
        //     echo '存在しないレビューはフォロー出来ない';
        // } else

        // if ($sessionId === $posterId) {
        //     //自分のレビューにはフォロー出来ない
        //     echo '自分のレビューにはフォロー出来ない';
        // } else {
        //     echo '正常';
        Following::create([
            'follower_user_id' => $sessionId,
            'poster_id' => $posterId,
            'followed_review_id' => $followedReviewId,
        ]);
        
        return response()->json(['result' => true]);
            
        // } elseif (empty(Following::where('follower_user_id', $sessionId)->select('followed_review_id')->get()->toArray()) === false) {
        //     //同じレビューにフォロー出来ない
        //     echo '同じレビューにフォロー出来ない';
    }

    /**
     * レビューへのフォローを解除する
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function unFollowReview(Request $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);

        //フォローするレビューのidを取得
        $followedReviewId = $request->followed_review_id;

       
        Following::where('follower_user_id', $sessionId)->where('followed_review_id', $followedReviewId)->delete();

        return response()->json(['result' => false]);
    }
}