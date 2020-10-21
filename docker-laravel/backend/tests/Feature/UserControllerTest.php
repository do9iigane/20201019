<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery as m;
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

    /**
     * @dataProvider getAgeProvider
     */
    public function testGetAge($birth, $assert, $flg)
    {
        $mock = $this->partialMock(User::class);
        $mock->shouldReceive('find')->with(1)->andReturn((object)['birth' => $birth]);

        if (method_exists($mock, 'getAge')) {
            if ($flg) {
                $this->assertEquals($mock->getAge(1), $assert);
            } else {
                $this->assertNotEquals($mock->getAge(1), $assert);
            }
        }

    }

    public function getAgeProvider()
    {
        return [
            ['2010-10-10', 10, true],
            ['1983-10-10', 37, true],
            ['1955-10-10', 65, true],
            ['1955-10-10', 99, false],
        ];
    }

    /**
     * @param $name
     * @param $assert
     * @param $flg
     * @dataProvider getNameProvider
     */
    public function testGetName($name, $assert, $flg)
    {
        $mock = $this->partialMock(User::class);
        $mock->shouldReceive('find')->with(1)->andReturn((object)['name' => $name]);

        if (method_exists($mock, 'getName')) {
            if ($flg) {
                $this->assertEquals($mock->getName(1), $assert);
            } else {
                $this->assertNotEquals($mock->getName(1), $assert);
            }
        }

    }

    public function getNameProvider()
    {
        return [
            ["田中太郎", "田中太郎", true],
            ["鈴木健二", "鈴木健二", true],
            ["斉藤正", "斉藤正", true],
            ["山田太郎", "内田太郎", false],
        ];
    }

    /**
     * @param $age
     * @param $assert
     * @param $flg
     * @dataProvider getCourseProvider
     */
    public function testGetCourse($age, $assert, $flg)
    {
        $mock = $this->partialMock(User::class);
        $mock->shouldReceive('getAge')->with(1)->andReturn($age);

        if (method_exists($mock, 'getCourse')) {
            if ($flg) {
                $this->assertEquals($mock->getCourse(1), $assert);
            } else {
                $this->assertNotEquals($mock->getCourse(1), $assert);
            }
        }

    }

    public function getCourseProvider()
    {
        return [
            ["44", "1日人間ドック", true],
            ["22", "基本健診", true],
            ["33", "基本健診", true],
            ["35", "基本健診", true],
            ["77", "基本健診", false],
        ];
    }
}
