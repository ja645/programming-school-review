<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReviewRepository;
use App\Services\RankingService;

class RankingController extends Controller
{
    /**
     * GETリクエストによってランキングを表示
     * 初期状態として'total_judg'によるランキングを返す
     * @return view
     */
    public function index()
    {        
        return view('auth.rankings');
    }

    /**
     * POSTリクエストによって指定されたカラムによるランキングを表示
     * @return view
     */
    public function showRanking(Request $request)
    {
        $column = request()->columnName;

        $schoolList = app(RankingService::class)->getSchoolList($column); 
        
        return response()->json(['schoolList' => $schoolList]);
    }
}
