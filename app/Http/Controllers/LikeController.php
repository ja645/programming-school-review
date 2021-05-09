<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * スクールページが表示された際に、現在のユーザーが
     * そのスクールをいいねしているか、と
     * そのスクールの現在のいいね数を返す
     * @param integer $id
     */
    public function current($id)
    {
        // 現在のユーザーが対象のスクールをいいねしているかを取得
        $school = app(School::class);
        $school = $school::find($id);
        $is_user_liked = $school->is_liked_by_auth_user();

        // logger($school->is_liked_by_auth_user());

        // 対象のスクールの現在のいいね数を取得
        $count = $school->likes->count();

        return response()->json(['bool' => $is_user_liked, 'count' => $count]);
    }


    /**
     * いいねボタンによっていいねの登録を解除を切り替える
     * スクールのいいね数もカウントして返す
     */
    public function switchLike(Request $request)
    {   
        $school_id = request()->schoolId;

        $school = app(School::class);
        $school = $school::find($school_id);
        $is_user_liked = $school->is_liked_by_auth_user();


        if (!$is_user_liked) {

            Like::create([
                'user_id' => Auth::id(),
                'school_id' => $school_id,
            ]);
    
            $school = app(School::class);
            $school = $school::find($school_id);
            $count = $school->likes->count();

            session()->flash('flash_message', 'スクールをいいねしました！');
    
            return response()->json(['bool' => true, 'count' => $count]);
        } else {
            Like::where('user_id', Auth::id())->where('school_id', $school_id)->delete();

            $school = app(School::class);
            $school = $school::find($school_id);
            $count = $school->likes->count();

            return response()->json(['bool' => false, 'count' => $count]);
        }
    }
}
