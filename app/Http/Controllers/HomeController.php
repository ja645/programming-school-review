<?php

namespace App\Http\Controllers;

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
        return view('auth.rankings');
    }

    /**
     * スクールページを表示
     * @return
     */
    public function showSchool()
    {
        return view('auth.school');
    }
}
