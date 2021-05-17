<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Review;
use App\Services\SchoolService;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    /**
     * スクール一覧を表示
     * @return view
     */
    public function showSchoolList()
    {   
        $schools = School::orderByDesc('created_at')->paginate(10);

        return view('auth.school.school-list', ['schools' => $schools]);
    }

    /**
     * スクールページを表示
     * @return
     */
    public function showSchool($id)
    {
        // 指定したidのスクールを取得
        $school = School::find($id);

        app()->bind(SchoolService::class, function(School $school) {
            return new SchoolService($school);
        });

        $SchoolService = app()->make(SchoolServiece::class);
        
        // $SchoolService = new SchoolService($school);

        dump($SchoolService->getSatisfactions());
        // スクールの満足度を取得
        $satisfactions = $SchoolService->getSatisfactions();

        // スクールの平均受講期間を取得
        $tuition_average = $SchoolService->getTuitionAverage();

        // スクールの平均受講料を取得
        $term_average = $SchoolService->getTermAverage();

        // スクールの順位を取得
        $school_rank = $SchoolService->getRank();

        // dump($school_rank);
        //総合評価のランキングとレビュー総数を表示
        return view('auth.school.school', [
            'school' => $school,
            'satisfactions' => $satisfactions,
            'tuition_average' => $tuition_average,
            'term_average' => $term_average,
            'school_rank' => $school_rank,
        ]);
    }

    /**
     * 検索ボックスに入力されたキーワードと
     * 名前が部分一致するスクールを表示する
     * @param \Illuminate\Http\Request $request
     * @return view
     */
    public function search(Request $request)
    {
        $school_name = $request->school_name;

        if($school_name != '') {
            $schools = School::where('school_name', 'like', '%'.$school_name.'%')
                        ->orderByDesc('created_at')->paginate(10);
        } else {

            // 検索ボックスに何も入力されなければ全てのスクールを返す
            $schools = School::orderByDesc('created_at')->paginate(10);

        }

        // dump(key($schools));
        return view('auth.school.school-list', ['schools' => $schools]);
    }
}