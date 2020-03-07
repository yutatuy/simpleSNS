<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(int $user_id)
    {
        $posts = Post::all();
        // $posts = Auth::user()->posts()->get();
        return view('user.index', [
            'posts' => $posts,
            'user_id' => $user_id,
        ]);
    }
}
