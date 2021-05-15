<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Following;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * レビューページが表示された際に、現在のユーザーが
     * そのレビューをフォローしているか、と
     * そのレビューの現在のフォロワー数を返す
     * @param integer $id
     */
    public function getCurrentStatus($id)
    {
        // 現在のユーザーが対象のレビューをフォローしているかを取得
        $review = app(Review::class);
        $review = $review->find($id);
        
        $is_user_followed = $review->is_followed_by_auth_user();

        // 対象のレビューの現在のフォロワー数を取得
        $count = $review->follows->count();

        return response()->json(['bool' => $is_user_followed, 'count' => $count]);
    }


    /**
     * フォローボタンによってフォローの登録と解除を切り替える
     * レビューのフォロワー数もカウントして返す
     */
    public function switchFollow(Request $request)
    {   
        $review_id = request()->reviewId;
        
        $review = app(Review::class);
        $review = $review->find($review_id);

        // 現在のユーザーがレビューの投稿者であれば更新できない
        if ($review_id === Auth::id()) {
            return response()->json(['flash' => '自分のレビューはフォロー出来ません。']);
        } else {
            // レビューが現在のユーザーにフォローされているか確認
            $is_review_followed = $review->is_followed_by_auth_user();
        
            if (!$is_review_followed) {
                // レビューがフォローされていなければfollowsテーブルにレコードを追加し、フォロワー数を更新
        
                Following::create([
                    'user_id' => Auth::id(),
                    'review_id' => $review_id,
                ]);

                $review = app(Review::class);
                $review = $review->find($review_id);
                $count = $review->follows->count();
                
                return response()->json(['bool' => true, 'count' => $count, 'flash' => 'レビューをフォローしました！']);
            } else {
                // レビューがフォローされていればfollowsテーブルからレコードを削除し、フォロワー数を更新
                Following::where('user_id', Auth::id())->where('review_id', $review_id)->delete();
        
                $review = app(Review::class);
                $review = $review->find($review_id);
                $count = $review->follows->count();
                
                return response()->json(['bool' => false, 'count' => $count, 'flash' => 'フォローを解除しました。']);
            }
        }
    }
}