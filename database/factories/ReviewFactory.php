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
            'course_id' => rand(0,4),
            'purpose' => rand(0,4),
            'result' => $this->faker->boolean,
            'language' => $this->faker->word,
            'title' => str_repeat('a test title', 2),
            'tuition' => rand(0,4),
            'term' => rand(0,4),
            'curriculum' => rand(0,4),
            'mentor' => rand(0,4),
            'support' => rand(0,4),
            'staff' => rand(0,4),
            'judgment' => rand(0,4),
            'report' => str_repeat('a test', 20),
        ];
    }
}
