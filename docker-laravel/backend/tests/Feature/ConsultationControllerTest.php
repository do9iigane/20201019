<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConsultationControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/consultation');
        $response->assertStatus(200);
        $response->assertSee("受診記録一覧");
    }

    public function testRegister()
    {
        $response = $this->get('/consultation/register/1');
        $response->assertStatus(200);
        $response->assertSee("受診記録登録");
    }

}
