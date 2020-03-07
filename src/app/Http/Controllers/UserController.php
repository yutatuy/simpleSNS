<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();
        $name = User::find($user->id)->name;
        return view('user.index', [
            'posts' => $posts,
            'name' => $name,
        ]);
    }
}
