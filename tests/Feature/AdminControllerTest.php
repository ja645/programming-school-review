<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;

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

        $response = $this->actingAs($this->isAdmin)->get('/admin');

        $response->assertStatus(200)->assertViewIs('admin.school-list');
    }

    /**
     * 管理者以外のユーザーが
     * スクールリストにアクセスすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotShowSchoolList()
    {
        Auth::login($this->isNotAdmin);

        $response = $this->actingAs($this->isNotAdmin)->get('/admin');

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

        $response->assertStatus(200)->assertViewIs('admin.add-school');
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

        $school_form = [
            'school_name' => 'test',
            'school_url' => 'test_url',
            'address' => 'test_address',
            'features' => 'test_features',
        ];

        $response = $this->actingAs($this->isAdmin)->post('/admin/create', $school_form);
        
        $this->assertDatabaseHas('schools', $school_form);
        
        $response->assertRedirect(route('school-list'));
    }

    /**
     * 管理者以外のユーザーが
     * 新規スクールを追加しようとすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotCreateSchool()
    {
        Auth::login($this->isNotAdmin);

        $school_form = [
            'school_name' => 'test',
            'school_url' => 'test_url',
            'address' => 'test_address',
            'features' => 'test_features',
        ];

        $response = $this->actingAs($this->isNotAdmin)->post('/admin/create', $school_form);

        $response->assertStatus(403);
    }

    /**
     * 管理者のアクセスで
     * スクール編集ページが表示されることをテスト
     * @return void
     */
    public function test_canShowEditSchool()
    {
        $school = School::factory()->create();

        Auth::login($this->isAdmin);

        $response = $this->actingAs($this->isAdmin)->get('/admin/edit/' . $school->id);

        $response->assertStatus(200)->assertViewIs('admin.edit-school');
    }

    /**
     * 管理者以外のユーザーが
     * スクール編集ページにアクセスすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotShowEditSchool()
    {
        $school = School::factory()->create();

        Auth::login($this->isNotAdmin);

        $response = $this->actingAs($this->isNotAdmin)->get('/admin/edit/' . $school->id);

        $response->assertStatus(403);
    }

    /**
     * 管理者が
     * スクールを編集出来ることをテスト
     * @return void
     */
    public function test_canEditSchool()
    {
        $school = School::factory()->create();

        Auth::login($this->isAdmin);

        $school_form = [
            'id' => $school->id,
            'school_name' => 'edited',
            'school_url' => 'edited_url',
            'address' => 'edited_address',
            'features' => 'edited_features',
        ];

        $response = $this->actingAs($this->isAdmin)->post('/admin/update', $school_form);

        $this->assertDatabaseHas('schools', $school_form);

        $response->assertRedirect(route('school-list'));
    }

    /**
     * 管理者以外のユーザーが
     * スクールデータを更新しようとすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotUpdateSchool()
    {
        $school = School::factory()->create();

        Auth::login($this->isNotAdmin);

        $school_form = [
            'id' => $school->id,
            'school_name' => 'edited',
            'school_url' => 'edited_url',
            'address' => 'edited_address',
            'features' => 'edited_features',
        ];

        $response = $this->actingAs($this->isNotAdmin)->post('/admin/update', $school_form);

        $response->assertStatus(403);
    }

    /**
     * 管理者が
     * スクールを削除出来ることをテスト
     * @return void
     */
    public function test_canDeleteSchool()
    {
        $school = School::factory()->create();

        Auth::login($this->isAdmin);

        $response = $this->actingAs($this->isAdmin)->post('/admin/delete', ['id' => $school->id]);

        $this->assertDatabaseMissing('schools', ['id' => $school->id]);

        $response->assertRedirect(route('school-list'));
    }

     /**
     * 管理者以外のユーザーが
     * スクールデータを削除しようとすると403にリダイレクトされることをテスト
     * @return void
     */
    public function test_nonAdministoratorCanNotDeleteSchool()
    {
        $school = School::factory()->create();

        Auth::login($this->isNotAdmin);

        $response = $this->actingAs($this->isNotAdmin)->post('/admin/delete', ['id' => $school->id]);

        $response->assertStatus(403);
    }
}
