<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'school_name' => 'test_school',
            'school_url' => 'test_url',
            'features' => [0 => 'test1', 1 => 'test2', 3 => 'test3'],
        ];
    }
}
