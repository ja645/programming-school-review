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
        $school = School::find($id);

        $SchoolService = new SchoolService($school);

        $satisfactions = $SchoolService->getSatisfactions();
        $tuition_average = $SchoolService->getTuitionAverage();
        $term_average = $SchoolService->getTermAverage();



        //総合評価のランキングとレビュー総数を表示
        return view('auth.school', [
            'school' => $school, 'satisfactions' => $satisfactions, 'tuition_average' => $tuition_average, 'term_average' => $term_average
        ]);
    }
}