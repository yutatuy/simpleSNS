<?php

namespace Tests\Feature\PostController;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class indexTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
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

        //userデータ作成→存在テスト
        $num = 3;
        for ($i = 1; $i <= $num; $i++) {
            factory(User::class)->create([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@user.com',
                'password' => 'password' . $i,
            ]);
        }
        for ($i = 1; $i <= $num; $i++) {
            $this->assertDatabaseHas('users', [
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@user.com',
                'password' => 'password' . $i,
            ]);
        }
        //postsデータ作成→存在テスト
        for ($i = 1; $i <= $num; $i++) {
            factory(Post::class)->create([
                'title' => 'user' . $i . 'の投稿',
                'image_url' => 'user' . $i . '.jpg',
                'user_id' => $i,
            ]);
        }
        for ($i = 1; $i <= $num; $i++) {
            $this->assertDatabaseHas('posts', [
                'title' => 'user' . $i . 'の投稿',
                'image_url' => 'user' . $i . '.jpg',
                'user_id' => $i,
            ]);
        }
    }

    //記事一覧
    public function testPostIndex()
    {
        // (/)が(/home)にリダイレクトされているか
        $response = $this->get('/');
        $response->assertRedirect('/home');
    }
}
