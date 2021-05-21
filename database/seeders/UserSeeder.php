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
        User::factory()->count(20)->create();

        $this->call([
            ReviewSeeder::class,
        ]);
    }
}
