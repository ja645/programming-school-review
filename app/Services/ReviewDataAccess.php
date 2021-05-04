<?php
declare(strict_type=1);

namespace App\Services;

interface ReviewDataAccess
{
  public function getRanking(String $column);
}