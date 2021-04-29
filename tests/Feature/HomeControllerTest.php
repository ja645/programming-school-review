<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * トップページが表示され、ログイン前後でヘッダーの内容が変わることをテスト
     * @return void
     */
    public function testIndex_正常系()
    {
        $response = $this->get('/');

        $response->assertStatus(200)->assertViewIs('layouts.top');
    }

    /**
     * ランキング一覧が表示されることをテスト
     * @return void
     */
    public function testShowRankings_正常系()
    {
        $response = $this->get('/rankings');

        $response->assertStatus(200)->assertViewIs('auth.rankings');
    }

    /**
     * スクールページが表示されることをテスト
     */
    public function testShowSchool_正常系()
    {
        $response = $this->get('/school');

        $response->assertStatus(200)->assertViewIs('auth.school');
    }
}
