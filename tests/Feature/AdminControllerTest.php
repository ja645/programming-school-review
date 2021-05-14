<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    private $isAdmin;

    private $isNotAdmin;

    public function setUp():void
    {
        parent::setUp();

        $this->isAdmin = User::factory(['id' => 1])->create();

        $this->isNotAdmin = User::factory()->create();
    }

    /**
     * 管理者のアクセスで
     * スクールリストが表示されることをテスト
     * @return void
     */
    public function test_canShowSchoolList()
    {
        Auth::login($this->isAdmin);

        $response = $this->actingAs($this->isAdmin)->get('school-list');

        $response->assertStatus(200)->assertViewIs('admin.school_list');
    }

    /**
     * 管理者以外のユーザーが
     * スクールリストにアクセスすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotShowSchoolList()
    {
        Auth::login($this->isNotAdmin);

        $response = $this->actingAs($this->isNotAdmin)->get('school-list');

        $response->assertStatus(403);
    }

    /**
     * 管理者のアクセスで
     * スクール追加ページが表示されることをテスト
     * @return void
     */
    public function test_canShowAddSchool()
    {
        Auth::login($this->isAdmin);

        $response = $this->actingAs($this->isAdmin)->get('/admin/add');

        $response->assertStatus(200)->assertViewIs('admin.add_school');
    }

    /**
     * 管理者以外のユーザーが
     * スクール追加ページにアクセスすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotShowAddSchool()
    {
        Auth::login($this->isNotAdmin);

        $response = $this->actingAs($this->isNotAdmin)->get('/admin/add');

        $response->assertStatus(403);
    }

    /**
     * 管理者が
     * スクールを追加出来ることをテスト
     * @return void
     */
    public function test_canAddSchool()
    {
        Auth::login($this->isAdmin);

        
    }

    /**
     * 管理者のアクセスで
     * スクール編集ページが表示されることをテスト
     * @return void
     */
    public function test_canShowEditSchool()
    {
        Auth::login($this->isAdmin);

        $response = $this->actingAs($this->isAdmin)->get('/admin/edit');

        $response->assertStatus(200)->assertViewIs('admin.edit_school');
    }

    /**
     * 管理者以外のユーザーが
     * スクール編集ページにアクセスすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotShowEditSchool()
    {
        Auth::login($this->isNotAdmin);

        $response = $this->actingAs($this->isNotAdmin)->get('/admin/edit');

        $response->assertStatus(403);
    }

    /**
     * 管理者が
     * スクールを編集出来ることをテスト
     * @return void
     */
    public function test_canEditSchool()
    {

    }

    /**
     * 管理者が
     * スクールを削除出来ることをテスト
     * @return void
     */
    public function test_canDeleteSchool()
    {

    }
}
