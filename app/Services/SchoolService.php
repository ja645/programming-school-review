<?php

namespace App\Services;

use App\Models\School;

class SchoolService
{
  protected $school;
 
  // public function __construct(School $school)
  // {
  //   $this->school = $school;
  // }


  /**
   * スクールに紐付いたレビューから満足度の平均値を取得し、配列にして返す
   * @return array
   */
  public function getSatisfactions(): array
  {
    $reviews = $this->school->reviews;

    $coloums = ['st_tuition', 'st_term', 'st_curriculum', 'st_mentor', 'st_support', 'st_staff', 'total_judg'];

    $satisfactions = [];

    $number_of_reviews = $reviews->count();

    foreach($coloums as $column) {
        $sum = $reviews->sum($column);

        // 0で割らないようにする
        if ($number_of_reviews !== 0) {
          $average = round($sum / $number_of_reviews, 1);

          // $averageが0の時は整数にキャスト
          if($average === 0.0) {
            $average = (int)$average;
          }
        } else {
          $average = 0;
        }

        $satisfactions[$column] = $average;
    }

    return $satisfactions;
  }

  /**
   * スクールに紐付いたレビューから受講料の平均を返す
   * @return integer
   */
  public function getTuitionAverage()
  {
    $reviews = $this->school->reviews;

    $number_of_reviews = $reviews->count();

    $sum = $reviews->sum('tuition');

    if ($number_of_reviews !== 0) {
      $average = round($sum / $number_of_reviews, 1);
    } else {
      $average = 0;
    }

    return (int)$average;
  }

  /**
   * スクールに紐付いたレビューから受講期間の平均を返す
   * @return double
   */
  public function getTermAverage()
  {
    $reviews = $this->school->reviews;

    $number_of_reviews = $reviews->count();

    $sum = 0;

    foreach($reviews as $review) {
      
      $start = $review->when_start;

      $end = $review->when_end;

      $term = $start->diffInDays($end);

      $sum += $term;
    }

    if ($number_of_reviews !== 0) {
      $average = round($sum / $number_of_reviews);
      
    } else {
      $average = 0;
    }

    return (int)$average;
  }

  /**
   * スクールのidを指定し
   * 総合評価の中での、そのスクールの順位を取得する
   * @return integer
   */
  public function getRank()
  {
    // 総合評価についてスクールリストを取得する
    $schoolList = app(RankingService::class)->getSchoolList('total_judg');

    // スクールリストを総合評価で降順に並べ替える
    foreach ((array) $schoolList as $key => $value) {
      $sort[$key] = $value['column'];
    }
    array_multisort($sort, SORT_DESC, $schoolList);

    // 指定したスクールが配列の何番目かを取得
    $rank = array_search($this->school->id, array_column($schoolList, 'school_id')) + 1;

    return $rank;
  }
}