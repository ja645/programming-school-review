<?php

namespace App\Http\Controllers;

use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * トップページを表示
     * @return view
     */
    public function index()
    {
        return view('layouts.top');
    }

    /**
     * ランキング一覧を表示
     * @return view
     */
    public function showRankings()
    {
        $arr_schools = app(ReviewRepository::class);

        return view('auth.rankings', ['arr_schools' => $arr_schools]);
    }

    /**
     * スクールページを表示
     * @return
     */
    public function showSchool()
    {
        //総合評価のランキングとレビュー総数を表示
        return view('auth.school');
    }
}
