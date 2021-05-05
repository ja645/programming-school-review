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
     * スクールページを表示
     * @return
     */
    public function showSchool()
    {
        //総合評価のランキングとレビュー総数を表示
        return view('auth.school');
    }
}
