<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Review;

class SchoolController extends Controller
{
    /**
     * スクールページを表示
     * @return
     */
    public function showSchool($id)
    {
        $school = School::find($id);

        $reviews = Review::where('school_id', $id)->get();

        //総合評価のランキングとレビュー総数を表示
        return view('auth.school', ['school' => $school, 'reviews' => $reviews]);
    }
}