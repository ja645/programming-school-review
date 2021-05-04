<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Services\ReviewDataAccess;
use App\Models\Review;
use App\Models\School;

class ReviewRepository implements ReviewDataAccess
{
  protected $Review;
  protected $School;

  public function __construct(Review $Review, School $School)
  {
    $this->Review = $Review;

    $this->School = $School;
  }

  /**
   * レビューをスクールに取得し、指定したフィールドの値を合計し配列にする
   * @param String $column
   * @return Array
   */
  public function getColumnSums(String $column): array
  {
    //スクールテーブルに存在するスクールの数を取得
    $school_number = $this->School::count();

    $array_sums = [];

    //レビューテーブルからスクールごとに指定したフィールドの値の合計を取得し、配列に格納
    for ($i = 1; $i <= $school_number; $i++) {
      $sum = $this->Review::where('school_id', $i)->sum($column);
      $array_sums['school_id'] = $i;
      $array_sums['sum'] = $sum;
    }

    return $array_sums;
  }
}