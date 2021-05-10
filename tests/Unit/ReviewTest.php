<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReviewTest extends TestCase
{
    /**
     * id_liked_by_auth_user()が正しく機能するかテスト
     * @test
     */
    public function  id_liked_by_auth_userが正しく機能する()
    {
        $user = User::factory()->create;

        Auth::login($user);

        $school = School::create(['school_name' => 'hogehoge']);
    }
}
