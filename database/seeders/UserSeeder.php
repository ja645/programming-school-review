<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * ユーザーのサンプルデータを用意
     *
     * @return void
     */
    public function run()
    {
        user::factory()->create(['user_name' => '三布留　太郎', 'sex' => 0, 'email' => 'sample@gmail.com']);
        User::factory()->count(10)->create();

        $this->call([
            SchoolSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
