<?php

namespace Tests\Feature\FavoriteController;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class favoriteTest extends TestCase
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
    public function testfavorite()
    {
        factory(Post::class)->create();

        //いいねを登録
        $this->post(route('favorites.favorite', ['post' => 1]));
        $this->assertDatabaseHas(
            'favorites',
            [
                'user_id' => Auth::id(),
                'post_id' => 1,
            ]
        );

        //いいねを解除
        $this->delete(route('favorites.unfavorite', ['post' => 1]));
        $this->assertDatabaseMissing(
            'favorites',
            [
                'user_id' => Auth::id(),
                'post_id' => 1,
            ]
        );
    }
}
