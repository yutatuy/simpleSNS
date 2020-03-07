@extends('layout')

@section('content')
    <h1>post edit</h1>
    <div class="u-mt-30">
        <ul>
            <li>{{ $post->title}}</li>
            <li>{{ $post->created_at}}</li>
            <li>{{ $post->updated_at}}</li>
       </ul>
       {{-- ログインユーザの投稿であれば表示 --}}
       @if ($post->user_id === Auth::user()->id )
            <p><span class="u-mt-30"><span><a href="{{ route('posts.edit', ['post' => $post])}}">編集</a></span></span></p>
            <p><span><a href="{{ route('posts.delete', ['post' => $post])}}">削除</a></span></p>
       @endif
    </div>
@endsection
