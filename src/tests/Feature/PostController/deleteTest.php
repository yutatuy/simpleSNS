<?php

namespace Tests\Feature\PostController;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class deleteTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        //おまじない
        parent::setUp();
        //DBの初期化
        Artisan::call('migrate:refresh');
        //ユーザ作成→ログイン→認証テスト
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        factory(Post::class, 5)->create();
        $this->assertDatabaseHas('posts', ['id' => 1]);
        $url = route('posts.delete', ['post' => 1]);
        $this->delete($url);
        $this->assertDatabaseMissing('posts', ['id' => 1]);
    }
}
