<?php

namespace App\Entities;

use App\Services\ReviewDataAccess;

class SchoolList
{
  private $SchoolList;

  private $ReviewDataAccess;

  public function __construct(ReviewDataAccess $ReviewDataAccess)
  {
    $this->SchoolList = [];

    $this->ReviewDataAccess = $ReviewDataAccess;
  }

  /**
   * ReviewDataAccessのgetAverageOfColumnSum()メソッドの値を、スクールidをキーとして配列にする
   * @param Int $school_id
   * @return array
   */
  public function add(Int $school_id, String $column): array
  {
    $averageOfColumnSum = $this->ReviewDataAccess->getAverageOfColumnSum($school_id, $column);
    
    $this->SchoolList = [$school_id => $averageOfColumnSum];

    return $this->SchoolList;
  }
}