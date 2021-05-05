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
     * @param String $column
     * @return array
     */
    public function getSchoolList(String $column): array
    {
      $numberOfSchools = $this->School::all()->count();
      
      $SchoolList = [];

      for ($i = 1; $i <= $numberOfSchools; $i ++) {
        $numberOfReviews = Review::where('school_id', $i)->count();
  
        $schoolName = $this->School::where('id', $i)->value('school_name');

        $columnSum = (int)Review::where('school_id', $i)->sum($column);
  
        $average = round($columnSum / $numberOfReviews, 1);
  
        $SchoolList[$schoolName] = $average;
      }
      
      return $SchoolList;
    }
}