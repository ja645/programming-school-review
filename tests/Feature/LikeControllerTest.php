<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use App\Models\Likes;
use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    private $myself;
    private $school;

    /**
     * テスト前に既存のユーザー、レビュー、およびfollowing関係を設定
     */
    public function setUp(): void
    {
        parent::setUp();

        //サンプルユーザーを用意
        $this->myself = User::factory()->create();

        //既存のスクールとして用意
        $this->school = School::create([
            'name' => 'hogehoge',
            'image_path' => 'hogehoge',
            'school_url' => 'hogehoge',
            'address' => 'hogehoge',
            'learning_style' => 1,
            'features' => 'hogehoge',
        ]);
    }

    /**
     * 認証済みのユーザーがスクールをお気に入りできることをテスト
     * @return void
     */
    public function testLike_正常系(): void
    {
        Auth::login($this->myself);

        $response = $this->actingAs($this->myself)->post('/like', [
            'school_id' => $this->school->id
        ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $this->myself->id, 'school_id' => $this->school->id,
        ]);

        $response->assertStatus(200);
    }

    /**
     * ログイン前のユーザーでエラー
     * @return void
     */
    public function testLike_異常系_未ログイン(): void
    {
        $response = $this->post('/like', [
            'school_id' => $this->school->id
        ]);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->myself->id, 'school_id' => $this->school->id,
        ]);

        $response->assertRedirect('login');
    }

    /**
     * ユーザーがスクールのお気に入りを解除できることをテスト
     * @return void
     */
    public function testUnLike_正常系(): void
    {
        Auth::login($this->myself);

        $response = $this->delete('/like/delete', [
            'school_id' => $this->school->id
        ]);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->myself->id, 'school_id' => $this->school->id,
        ]);

        $response->assertStatus(200);
    }
}
