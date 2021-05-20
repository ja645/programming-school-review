<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolDataController extends Controller
{
    /**
     * スクール一覧ページを表示する
     * @return view
     */
    public function showSchoolList()
    {
        $schools = School::all()->paginate(10);

        return view('admin.school-list', ['schools' => $schools]);
    }

    /**
     * スクール追加ページを表示する
     * 管理者のみ閲覧可能
     * @return view
     */
    public function showAddSchool()
    {
        return view('admin.add-school');
    }

    /**
     * データベースに新規スクールを追加する
     * @param \Illuminate\Http\Request  $requests
     * @return Illuminate\Support\Facades\Redirect
     */
    public function addSchool(Request $request)
    {
        $school_form = $request->all();
       
        $school = School::create($school_form);

        return redirect(route('school-list'));
   }

   /**
    * スクールの更新ページを表示する
    *@return view
    */
   public function showEditSchool(Request $request)
   {
        $school = School::find($request->id);

        return view('admin.edit-school', ['school' => $school]);
   }

   /**
    * スクールの更新をする
    * @param \Illuminate\Http\Request  $request
    * @return Illuminate\Support\Facades\Redirect
    */
    public function updateSchool(Request $request)
    {  
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
        $school = School::find($request->id)->delete();

        return redirect(route('school-list'));
    }
}
