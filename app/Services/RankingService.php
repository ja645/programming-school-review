<?php

namespace App\Services;

use App\Models\School;

class RankingService
{
  protected $school;
 
  public function __construct(School $school)
  {
    $this->school = $school;
  }

  /**
   * スクールに紐付いたレビューから満足度の平均値を取得し、配列にして返す
   * @return array
   */
  public function getSchoolList($column): array
  {
    // スクールの総数を取得
    $schools = $this->school->all();
    
    $schoolList = [];

    foreach($schools as $school) {
      // 指定したカラムの合計を取得
      $sum = $school->reviews->sum($column);

      // スクールに紐付くレビューの総数を取得
      $number_of_reviews = $school->reviews->count();
      
      if ($number_of_reviews !== 0) {
        $average = round($sum / $number_of_reviews, 1);
      } else {
        $average = 0;
      }

      $schoolList[] = ['school_id' => $school->id, 'school_name' => $school->school_name, 'column' => $average];
    }

    return $schoolList;
  }
}