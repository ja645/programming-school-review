<?php

namespace Tests\Unit;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Tests\TestCase;

class UserTest extends TestCase
{
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
        $this->assertDatabaseHas('users', $user);
    }

    public function testCanUpdate()
    {
        $user = User::factory()->create(['name' => '山田']);
        $user->update(['user_name' => '山本']);
        $this->assertDatabaseHas('users', [
            'name' => '山本',
        ]);
    }

    public function testCanDelete()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->assertDatabaseMissing('users', $user);
    }

}
