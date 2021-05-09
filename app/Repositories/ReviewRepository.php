<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Services\ReviewDataAccess;
use App\Models\Review;
use App\Models\School;
use PhpParser\Node\Expr\Cast\Double;

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
     * レビューの満足度のフィールドの1つを指定し、
     * そのフィールドの平均値を返す
     */
    /**
     * @param String $column
     * @return float
     */
    public function getSchoolList(String $column): float
    {
      // レビューの総数を取得
      $number_of_reviews = $this->Review->count();

      // レビューの指定したカラムについて、その合計を取得
      $column_sum = $this->Review->sum($column);
      
      // 小数点第2位を四捨五入する
      $column_average = round($column_sum / $number_of_reviews, 1);

      return $column_average;
    }
}