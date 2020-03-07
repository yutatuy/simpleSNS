<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Methods\Methods;

class FavoriteController extends Controller
{
    //いいね登録
    public function store($postId)
    {
        if (!(Methods::is_favorite($postId))) {
            $user = Auth::user();
            $user->favorites()->attach($postId);
            return redirect('/posts');
        } else {
            return false;
        }
    }
    //いいね解除
    public function destroy($postId)
    {
        if (Methods::is_favorite($postId)) {
            $user = Auth::user();
            $user->favorites()->detach($postId);
            return redirect('/posts');
        } else {
            return false;
        }
    }
}
