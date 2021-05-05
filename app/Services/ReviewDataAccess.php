<?php
declare(strict_types=1);

namespace App\Services;

interface ReviewDataAccess
{
  public function getAverageOfColumnSum(Int $school_id, String $column);
}