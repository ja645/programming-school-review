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
      $number_of_schools = $this->School::all()->count();
      
      $SchoolList = [];

      for ($i = 1; $i <= $number_of_schools; $i ++) {
        $number_of_reviews = Review::where('school_id', $i)->count();
  
        $columnSum = (int)Review::where('school_id', $i)->sum($column);
  
        $average = round($columnSum / $number_of_reviews, 1);
  
        $SchoolList[$i] = $average;
      }
      
      return $SchoolList;
    }
}