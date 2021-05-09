<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Review;
use App\Services\SchoolSatisfactionsService;

class SchoolController extends Controller
{
    /**
     * スクールページを表示
     * @return
     */
    public function showSchool($id)
    {
        $school = School::find($id);

        $satisfactions = new SchoolSatisfactionsService($school);

        $satisfactions = $satisfactions->getSatisfactions();

        //総合評価のランキングとレビュー総数を表示
        return view('auth.school', ['school' => $school, 'satisfactions' => $satisfactions]);
    }
}