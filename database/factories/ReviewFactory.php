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
        return [
            'school_id' => rand(0,20),
            'course' => $this->faker->name,
            'tuition' => rand(100000, 999999),
            'purpose' => rand(0,4),
            'when_start' => $this->faker->date('Y-m-d'),
            'when_end' => $this->faker->date('Y-m-d'),
            'at_school' => $this->faker->boolean,
            'achievement' => rand(0,4),
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
