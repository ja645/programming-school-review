<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Review;
use App\Services\SchoolService;

class SchoolController extends Controller
{
    /**
     * スクールページを表示
     * @return
     */
    public function showSchool($id)
    {
        // 指定したidのスクールを取得
        $school = School::find($id);

        $SchoolService = new SchoolService($school);

        // スクールの満足度を取得
        $satisfactions = $SchoolService->getSatisfactions();

        // スクールの平均受講期間を取得
        $tuition_average = $SchoolService->getTuitionAverage();

        // スクールの平均受講料を取得
        $term_average = $SchoolService->getTermAverage();

        // スクールの順位を取得
        $school_rank = $SchoolService->getRank();


        //総合評価のランキングとレビュー総数を表示
        return view('auth.school', [
            'school' => $school,
            'satisfactions' => $satisfactions,
            'tuition_average' => $tuition_average,
            'term_average' => $term_average,
            'school_rank' => $school_rank,
        ]);
    }
}