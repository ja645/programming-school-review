<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Services\ReviewDataAccess;
use App\Models\Review;
use PhpParser\Node\Expr\Cast\Double;

class ReviewRepository implements ReviewDataAccess
{
    protected $Review;

    public function __construct(Review $Review)
    {
      $this->Review = $Review;
    }

    public function getAverageOfColumnSum(Int $school_id, String $column): float
    {
      $total_reviews = Review::where('school_id', $school_id)->count();

      $columnSum = (int)Review::where('school_id', $school_id)->sum($column);

      $average = $columnSum / $total_reviews;

      return round($average, 1);
    }
}