<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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
        $origin = $request->file('image_url')->getClientOriginalName();
        $url = $request->image_url->storeAs('public/images', $origin);
        $post->image_url = str_replace('public/', 'storage/', $url);
        Auth::user()->posts()->save($post);
        return redirect()->route('posts.index');
    }
    public function detail(Post $post)
    {
        // $post = Post::find($id);

        return view('posts.detail', [
            'post' => $post,
        ]);
    }
    public function showEditForm(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
        ]);
    }
    public function edit(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->save();
        return redirect()->route('posts.index');
    }
    public function delete(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
