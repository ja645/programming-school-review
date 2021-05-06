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
}
