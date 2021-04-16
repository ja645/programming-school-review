<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Models\Following;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * 他のユーザーのレビューをフォロー
     * @param \App\Http\Requests\FollowRequest $request
     */
    public function followReview(FollowRequest $request)
    {
        // $followerUserId = $request->follower_user_id;
        // $followedReviewId = $request->followed_review_id;

        Following::create($request);

    }
}
