<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Methods\Methods;
use App\Post;

class FavoriteController extends Controller
{
    //いいね登録
    public function store(Post $post)
    {
        $postId = $post->id;
        if (!(Methods::is_favorite($postId))) {
            $user = Auth::user();
            $user->favorites()->attach($postId);
            return redirect('/home');
        } else {
            return false;
        }
    }
    //いいね解除
    public function destroy(Post $post)
    {
        $postId = $post->id;
        if (Methods::is_favorite($postId)) {
            $user = Auth::user();
            $user->favorites()->detach($postId);
            return redirect('/home');
        } else {
            return false;
        }
    }
}
