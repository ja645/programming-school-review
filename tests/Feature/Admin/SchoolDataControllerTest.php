<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;

class SchoolDataControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 管理者としてログイン済みのユーザーが
     * スクールリストページにアクセス出来ることをテスト
     * 
     * @return void
     */
    public function test_administrator_can_visit_schoolList()
    {
        $response = $this->withSession(['admin_auth' => true])->get('/admin');

        $response->assertStatus(200)->assertViewIs('admin.school-list');
    }

    /**
     * 管理者としてログインしていないユーザーがスクールリストにアクセスすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_administorator_can_not_visit_schoolList()
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 管理者としてログイン済みのユーザーが
     * スクール追加ページにアクセス出来ることをテスト
     * 
     * @return void
     */
    public function test_administrator_can_visit_addSchool()
    {
        $response = $this->withSession(['admin_auth' => true])->get('/admin/add');

        $response->assertStatus(200)->assertViewIs('admin.add-school');
    }

    /**
     * 管理者としてログインしていないユーザーがスクール追加ページにアクセスすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_administorator_can_not_visit_addSchool()
    {
        $response = $this->get('/admin/add');

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 管理者としてログイン済みのユーザーが
     * スクールを追加出来ることをテスト
     * @return void
     */
    public function test_administrator_can_add_school()
    {
        $school_form = [
            'school_name' => 'test',
            'school_url' => 'test_url',
            'features' => "['test1', 'test2', 'test3', 'test4']",
        ];

        $response = $this->withSession(['admin_auth' => true])->post('/admin/create', $school_form);
        
        $this->assertDatabaseHas('schools', $school_form);
        
        $response->assertRedirect(route('school-list'));
    }

    /**
     * 管理者としてログインしていないユーザーが新規スクールを追加しようとすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_administorator_can_not_add_School()
    {
        $school_form = [
            'school_name' => 'test',
            'school_url' => 'test_url',
            'features' => ['test1', 'test2', 'test3', 'test4'],
        ];

        $response = $this->post('/admin/create', $school_form);

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 管理者としてログイン済みのユーザーが
     * スクール編集ページにアクセス出来ることをテスト
     * 
     * @return void
     */
    public function test_administrator_can_visit_editSchool()
    {
        $school = School::factory()->create();

        $response = $this->withSession(['admin_auth' => true])->post('/admin/edit', ['id' => $school->id]);

        $response->assertStatus(200)->assertViewIs('admin.edit-school');
    }

    /**
     * 管理者としてログインしていないユーザーがスクール編集ページにアクセスすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_administorator_can_not_visit_editSchool()
    {
        $school = School::factory()->create();

        $response = $this->post('/admin/edit', ['id' => $school->id]);

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 管理者としてログイン済みのユーザーが
     * スクールを編集出来ることをテスト
     * @return void
     */
    public function test_administrator_can_update_school()
    {
        $school = School::factory()->create();

        $school_form = [
            'id' => $school->id,
            'school_name' => 'edited',
            'school_url' => 'edited_url',
            'features' => "['test1', 'test2', 'test3', 'test4']",
        ];

        $response = $this->withSession(['admin_auth' => true])->post('/admin/update', $school_form);

        $this->assertDatabaseHas('schools', $school_form);

        $response->assertRedirect(route('school-list'));
    }

    /**
     * 管理者としてログインしていないユーザーがスクールデータを更新しようとすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_administorator_can_not_update_school()
    {
        $school = School::factory()->create();

        $school_form = [
            'id' => $school->id,
            'school_name' => 'edited',
            'school_url' => 'edited_url',
            'features' => ['test1', 'test2', 'test3', 'test4'],
        ];

        $response = $this->post('/admin/update', $school_form);

        $response->assertRedirect(route('admin.login'));
    }

    /**
     * 管理者としてログイン済みのユーザーが
     * スクールを削除出来ることをテスト
     * 
     * @return void
     */
    public function test_administrator_can_delete_school()
    {
        $school = School::factory()->create();

        $response = $this->withSession(['admin_auth' => true])->post('/admin/delete', ['id' => $school->id]);

        $this->assertDatabaseMissing('schools', ['id' => $school->id]);

        $response->assertRedirect(route('school-list'));
    }

     /**
     * 管理者としてログインしていないユーザーがスクールデータを削除しようとすると
     * 管理者ログインページにリダイレクトされることをテスト
     * 
     * @return void
     */
    public function test_non_sdministorator_can_not_delete_school()
    {
        $school = School::factory()->create();

        $response = $this->post('/admin/delete', ['id' => $school->id]);

        $response->assertRedirect(route('admin.login'));
    }
}
