<?php

namespace App\Methods;

use Illuminate\Support\Facades\Auth;

class Methods
{
    public static function is_favorite($postId)
    {
        $user = Auth::user();
        return $user->favorites()->where('post_id', $postId)->exists();
    }
}
