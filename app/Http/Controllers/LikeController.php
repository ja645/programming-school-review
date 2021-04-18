<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * スクールをお気に入り登録
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);

        //フォローするレビューのidを取得
        $schoolId = $request->school_id;

        Like::create([
            'user_id' => $sessionId,
            'school_id' => $schoolId,
        ]);

        return response()->json(['result' => true]);
    }

    /**
     * スクールをお気に入り解除
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function unLike(Request $request)
    {
        //セッションから、リクエストしてきたユーザーのidを取り出す
        $sessionKey = config('hideSessionId.session-id');
        $sessionId = $request->session()->get($sessionKey);

        //フォローするレビューのidを取得
        $schoolId = $request->school_id;

        Like::where('user_id', $sessionId)->where('school_id', $schoolId)->delete();

        return response()->json(['result' => false]);
    }
}
