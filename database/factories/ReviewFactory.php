<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // when_startに挿入する日付を生成
        $start_at = $this->faker->dateTime();

        return [
            'school_id' => 1,
            'course' => $this->faker->name(),
            'tuition' => rand(100000, 999999),
            'purpose' => rand(0,4),
            'when_start' => $start_at,
            // when_atから1~12ヶ月後のランダムな日付を挿入
            'when_end' => $this->faker->dateTimeInInterval($start_at, '+' . rand(31, 365) . 'days'),
            'at_school' => $this->faker->boolean(),
            'st_tuition' => rand(0,4),
            'st_term' => rand(0,4),
            'st_curriculum' => rand(0,4),
            'st_mentor' => rand(0,4),
            'st_support' => rand(0,4),
            'st_staff' => rand(0,4),
            'total_judg' => rand(0,4),
            'title' => str_repeat('a test title', 2),
            'report' => str_repeat('a test', 20),
        ];
    }
}
