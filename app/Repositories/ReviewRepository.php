<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Services\ReviewDataAccess;
use App\Models\Review;

class ReviewRepository implements ReviewDataAccess
{
    protected $Review;

    public function __construct(Review $Review)
    {
      $this->Review = $Review;
    }

    public function getColumnSum(Int $school_id, String $column): Int
    {
      return (int)Review::where('school_id', $school_id)->sum($column);
    }
}