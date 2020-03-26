<?php

namespace Tests\Feature\PostController;

use Tests\TestCase;
use App\User;
use App\Post;
use App\Reply;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class detailTest extends TestCase
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
    //記事詳細
    public function testPostDetail()
    {
        //記事数
        $postNum = 3;
        //DBに記事を保存
        factory(Post::class, $postNum)->create();
        //全記事にアクセスできているか
        for ($i = 1; $i <= $postNum; $i++) {
            $response = $this->get('/posts/' . $i);
            $response->assertStatus(200);
        }
    }

    //返信機能
    /**
     * /posts/{post}/replyCreate
     * 正常系
     *
     * @return void
     */
    public function testReply()
    {
        //DBに記事を保存
        factory(Post::class)->create();

        //urlを設定
        $url = route('reply.create', ['post' => 1]);

        //replyデータ作成
        $replyData = [
            'content' => 'reply'
        ];
        $response = $this->post($url, $replyData);

        $this->assertDatabaseHas('replies', $replyData);

        //詳細ページにリダイレクトしているか
        $response->assertRedirect('/posts/1');
    }
    /**
     * /posts/{post}/replyCreate
     * 異常系
     *
     * @return void
     */
    public function testReplyError()
    {
        //DBに記事を保存
        factory(Post::class)->create();

        //urlを設定
        $url = route('reply.create', ['post' => 1]);

        //replyデータ作成
        $replyData = [
            'content' => ''
        ];
        $this->post($url, $replyData);
        $this->assertDatabaseMissing('replies', $replyData);
    }
}
