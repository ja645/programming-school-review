<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReviewRepository;

class RankingController extends Controller
{
    /**
     * ランキング一覧を表示
     * @return view
     */
    public function showRankings()
    {
        $arr_schools = app(ReviewRepository::class)->getSchoolList('total_judg');
        
        return view('auth.rankings', ['arr_schools' => $arr_schools]);
    }
}
