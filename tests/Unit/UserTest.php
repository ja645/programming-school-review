<?php

namespace Tests\Unit;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * all,getが配列を返すか、必要なフィールドを返すか
     * ユーザー登録、更新、削除が出来るか
     * バリデーションは機能しているか
     *バリデーション失敗時に正しくメッセージが表示される
     *認証メールが送信されるか
     * @return void
     */
    public function testCanCreate()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function testCanUpdate()
    {
        $user = User::factory()->create(['user_name' => '山田']);
        $user->where('id', $user->id)->update(['user_name' => '山本']);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'user_name' => '山本',
        ]);
    }

    public function testCanDelete()
    {
        $user = User::factory()->create();
        $user->where('id', $user->id)->delete();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

}
