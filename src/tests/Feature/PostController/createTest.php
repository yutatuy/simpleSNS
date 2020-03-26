<?php

namespace Tests\Feature\PostController;

use Tests\TestCase;
use App\User;
use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class createTest extends TestCase
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
     * /posts/create
     * 正常系
     *
     * @return void
     */
    public function testPostCreate()
    {

        //urlを設定
        $url = route('posts.create');

        //正解データを作成
        $trueData = [
            'title' => 'potato',
        ];

        //Post.createにPost送信
        $response = $this->post($url, $trueData);

        //正解データがDBに登録されたか
        $this->assertDatabaseHas('posts', $trueData);
        // 登録が完了して一覧画面にリダイレクトしているか
        $response->assertRedirect('/home');
    }
    /**
     * /posts/create
     * 異常系
     *
     * @return void
     */
    public function testPostCreateError()
    {
        //urlを設定
        $url = route('posts.create');

        //不正解データを作成
        $falseData = [
            'title' => '',
        ];

        //Post.createにPost送信
        $this->post($url, $falseData);

        //DBに登録されてないか
        $this->assertDatabaseMissing('posts', $falseData);
    }
}
