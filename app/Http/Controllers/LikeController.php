<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * スクールをお気に入り登録
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        //現在認証されているユーザーのidを取り出す
        $userId = Auth::id();

        //いいねするレビューのidを取得
        $schoolId = $request->school_id;

        Like::create([
            'user_id' => $userId,
            'school_id' => $schoolId,
        ]);

        session()->flash('flash_message', 'スクールをいいねしました！');

        return response()->json(['result' => true]);
    }

    /**
     * スクールをお気に入り解除
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function unLike(Request $request)
    {
        $userId = Auth::id();

        //フォローするレビューのidを取得
        $schoolId = $request->school_id;

        Like::where('user_id', $userId)->where('school_id', $schoolId)->delete();

        return response()->json(['result' => false]);
    }

    public function switchLike(Request $request)
    {   
        logger($request->session()->all());
        $school_id = request()->schoolId;

        $school = app(School::class);
        $school = $school::find($school_id);
        $is_user_liked = $school->is_liked_by_auth_user();

        if (!$is_user_liked) {

            Like::create([
                'user_id' => auth()->id(),
                'school_id' => $school_id,
            ]);
    
            session()->flash('flash_message', 'スクールをいいねしました！');
    
            return response()->json(['bool' => true]);
        } else {
            Like::where('user_id', Auth::id())->where('school_id', $school_id)->delete();

            return response()->json(['bool' => false]);
        }
    }
}
