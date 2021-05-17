<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Services\RankingService;

class School extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass nonassignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * スクールに投稿されたレビューを取得
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * スクールとお気に入りしたユーザーを紐付けるfollowingを取得
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * 現在認証中のユーザーが
     * スクールをいいねしているか判定する
     */
    public function is_liked_by_auth_user()
    {
        // 現在認証されているユーザーのidを取得
        $id = Auth::id();
        
        $likers = [];

        // 配列にレビューをlikeしているユーザーのidを格納
        foreach ($this->likes as $like) {
            array_push($likers, $like->user_id);
        }

        // 配列に認証中のユーザーidがあればtrueを返す
        if (in_array($id, $likers)) {
            
            return true;
        } else {
            
            return false;
        }
    }

    /**
   * スクールに紐付いたレビューから満足度の平均値を取得し、配列にして返す
   * @return array
   */
  public function getSatisfactions(): array
  {
    $reviews = $this->reviews;

    $coloums = ['st_tuition', 'st_term', 'st_curriculum', 'st_mentor', 'st_support', 'st_staff', 'total_judg'];

    $satisfactions = [];

    $number_of_reviews = $reviews->count();

    foreach($coloums as $column) {
        $sum = $reviews->sum($column);

        // 0で割らないようにする
        if ($number_of_reviews !== 0) {
          $average = round($sum / $number_of_reviews, 1);

          // $averageが0の時は整数にキャスト
          if($average === 0.0) {
            $average = (int)$average;
          }
        } else {
          $average = 0;
        }

        $satisfactions[$column] = $average;
    }

    return $satisfactions;
  }

  /**
   * スクールに紐付いたレビューから受講料の平均を返す
   * @return integer
   */
  public function getTuitionAverage()
  {
    $reviews = $this->reviews;

    $number_of_reviews = $reviews->count();

    $sum = $reviews->sum('tuition');

    if ($number_of_reviews !== 0) {
      $average = round($sum / $number_of_reviews, 1);
    } else {
      $average = 0;
    }

    return (int)$average;
  }

  /**
   * スクールに紐付いたレビューから受講期間の平均を返す
   * @return double
   */
  public function getTermAverage()
  {
    $reviews = $this->reviews;

    $number_of_reviews = $reviews->count();

    $sum = 0;

    foreach($reviews as $review) {
      
      $start = $review->when_start;

      $end = $review->when_end;

      $term = $start->diffInDays($end);

      $sum += $term;
    }

    if ($number_of_reviews !== 0) {
      $average = round($sum / $number_of_reviews);
      
    } else {
      $average = 0;
    }

    return (int)$average;
  }

  /**
   * スクールのidを指定し
   * 総合評価の中での、そのスクールの順位を取得する
   * @return integer
   */
  public function getRank()
  {
    // 総合評価についてスクールリストを取得する
    $schoolList = app(RankingService::class)->getSchoolList('total_judg');

    // スクールリストを総合評価で降順に並べ替える
    foreach ((array) $schoolList as $key => $value) {
      $sort[$key] = $value['column'];
    }
    array_multisort($sort, SORT_DESC, $schoolList);

    // 指定したスクールが配列の何番目かを取得
    $rank = array_search($this->id, array_column($schoolList, 'school_id')) + 1;

    return $rank;
  }
}
