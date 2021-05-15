<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\School;
use App\Services\SchoolService;

class AdminController extends Controller
{
    /**
     * スクール一覧ページを表示する
     * @return view
     */
    public function showSchoolList()
    {
        // 管理者以外のアクセスには403を返す
        Gate::authorize('isAdmin');

        $schools = School::all();

        return view('admin.school-list', ['schools' => $schools]);
    }

    /**
     * スクール追加ページを表示する
     * 管理者のみ閲覧可能
     * @return view
     */
    public function showAddSchool()
    {
        // 管理者以外のアクセスには403を返す
        Gate::authorize('isAdmin');

        return view('admin.add-school');
    }

    /**
     * データベースに新規スクールを追加する
     * @param \Illuminate\Http\Request  $requests
     * @return Illuminate\Support\Facades\Redirect
     */
    public function addSchool(Request $request)
    {
        Gate::authorize('isAdmin');

        $school_form = $request->all();
       
        $school = School::create($school_form);

        return redirect(route('school-list'));
   }

   /**
    * スクールの更新ページを表示する
    *@return view
    */
   public function showEditSchool(int $id)
   {
        Gate::authorize('isAdmin');

        $school = School::find($id);

        return view('admin.edit-school', ['school' => $school]);
   }

   /**
    * スクールの更新をする
    * @param \Illuminate\Http\Request  $request
    * @return Illuminate\Support\Facades\Redirect
    */
    public function updateSchool(Request $request)
    {
        Gate::authorize('isAdmin');
       
        $school = School::find($request->id);

       $school->fill($request->except('id'))->save();

       return redirect(route('school-list'));
    }

    /**
     * スクールを削除する
     * @param \Illuminate\Http\Request  $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function deleteSchool(Request $request)
    {
        Gate::authorize('isAdmin');

        $school = School::find($request->id)->delete();

        return redirect(route('school-list'));
    }
}