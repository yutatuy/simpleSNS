<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Post;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * プロフィールの保存
     *
     * @param CreatePost $request
     * @return Response
     */

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }
    public function showCreateForm()
    {
        return view('posts.create');
    }

    public function create(CreatePost $request)
    {
        $post = new Post();
        $post->title = $request->title;
        if ($request->file('image_url')) {
            $url = $request->image_url->store('public/images');
            $post->image_url = str_replace('public/', './../storage/', $url);
        }
        Auth::user()->posts()->save($post);
        return redirect()->route('posts.index');
    }
    public function detail(Post $post)
    {
        // $post = Post::find($id);
        $replies = Reply::where('parent_id', $post->id)->get();
        return view('posts.detail', [
            'post' => $post,
            'replies' => $replies,
        ]);
    }
    public function showEditForm(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
        ]);
    }
    public function edit(CreatePost $request, Post $post)
    {
        $post->title = $request->title;
        if ($request->file('image_url')) {
            $url = $request->image_url->store('public/images');
            $post->image_url = str_replace('public/', './../storage/', $url);
        }
        $post->save();
        return redirect()->route('posts.detail', ['post' => $post]);
    }
    public function delete(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }

    // リプライ追加
    public function replyCreate(Request $request, Post $post)
    {
        //新たな返信をreply-tableに追加
        $reply = new Reply();
        $reply->parent_id = $post->id;
        $reply->user_id = Auth::user()->id;
        $reply->content = $request->content;
        Auth::user()->replies()->save($reply);

        // $post = Post::find($post->id);
        return redirect()->route('posts.detail', ['post' => $post]);
    }
}
