<?php

namespace Tests\Unit;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public $userData = [
                'user_name' => '田中 太郎',
                'birthday' => '2013-5-30 00:00:00.000000',
                'sex' => 2,
                'former_job' => '公務員',
                'job' => 'エンジニア',
                'school_id' => 1,
                'email' => 'test@gmail.com',
                'password' => 'password1',
                'password_confirmation' => 'password1',
            ];
    
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
        $user = User::create($this->userData);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function testCanUpdate()
    {
        $user = User::create($this->userData);

        $user->where('id', $user->id)->update(['user_name' => '山本']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'user_name' => '山本',
        ]);
    }

    public function testCanDelete()
    {
        $user = User::create($this->userData);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);

        $user->where('id', $user->id)->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
