<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee("ユーザー一覧");
    }

    public function testRegister()
    {
        $response = $this->get('/user/register');
        $response->assertStatus(200);
        $response->assertSee("ユーザー登録");
    }

    public function testDetail()
    {
        $response = $this->get('/user/detail/2');
        $response->assertStatus(200);
        $response->assertSee("ユーザー詳細");
    }
}
