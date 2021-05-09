<?php

namespace App\Services;

use App\Models\School;

class SchoolSatisfactionsService
{
  protected $school;
 
  public function __construct(School $school)
  {
    $this->school = $school;
  }


  /**
   * 
   */
  public function getSatisfactions(): array
  {
    $reviews = $this->school->reviews;

    $coloums = ['st_tuition', 'st_term', 'st_curriculum', 'st_mentor', 'st_support', 'st_staff'];

    $satisfactions = [];

    $number_of_reviews = $reviews->count();

    foreach($coloums as $column) {
        $sum = $reviews->sum($column);

        $average = round($sum / $number_of_reviews, 1);

        $satisfactions[$column] = $average;
    }

    return $satisfactions;
  }
}