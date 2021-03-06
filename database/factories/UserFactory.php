<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_name' => $this->faker->name(),
            'sex' => rand(0, 2),
            'birthday' => $this->faker->dateTime,
            'former_job' => $this->faker->jobTitle,
            'job' => $this->faker->jobTitle,
            'email' => $this->faker->unique()->freeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password1'), // password1
            'remember_token' => Str::random(10),
        ];
    }
}
