<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\User;
use App\Models\Like;

class SchoolTest extends TestCase
{
    private $user;
    private $school;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->school = School::factory()->create();
    }

    /**
     * ユーザーがスクールをいいねしている場合に
     * id_liked_by_auth_user()がtrueを返すことをテスト
     * @test
     */
    public function  id_liked_by_auth_userがtrueを返す()
    {
        Auth::login($this->user);

        // 現在のユーザーがレビューをフォローしている状態を作る
        Like::create(['user_id' => $this->user->id, 'school_id' => $this->school->id]);

        $is_school_liked = $this->school->is_liked_by_auth_user();

        $this->assertTrue($is_school_liked);
    }

    /**
     * ユーザーがレビューをフォローしていない場合に
     * id_liked_by_auth_user()がfalseを返すことをテスト
     * @test
     */
    public function  id_liked_by_auth_userがfalseを返す()
    {
        Auth::login($this->user);

        $is_school_liked = $this->school->is_liked_by_auth_user();

        $this->assertFalse($is_school_liked);
    }
}
