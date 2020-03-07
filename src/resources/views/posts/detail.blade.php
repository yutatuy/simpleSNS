@extends('layout')

@section('content')
    <h1>post detail</h1>
    <div class="u-mt-30">
        <ul>
            <li>{{ $post->title}}</li>
            @if (!($post->image_url === 'aaa'))
                <li><img src="{{ $post->image_url }}"></li>
            @endif
            <li>{{ $post->created_at}}</li>
            <li>{{ $post->updated_at}}</li>
       </ul>
       {{-- ログインユーザの投稿であれば編集と削除が可能 --}}
       @if ($post->user_id === Auth::user()->id )
            <p><span class="u-mt-30"><span><a href="{{ route('posts.edit', ['post' => $post])}}">編集</a></span></span></p>
            <p><span><a href="{{ route('posts.delete', ['post' => $post])}}">削除</a></span></p>
       @endif
       {{-- 返信一覧 --}}
       <ul class="u-mt-30">
        @foreach ($replies as $reply)
            <li><span>{{ $reply->user_id }}：</span><span>{{ $reply->content }}</span></li>
        @endforeach
       </ul>
       {{-- 返信フォーム --}}
       <div class="u-mt-30">
            <form action="{{ route('reply.create',['parent_id' => $post->id]) }}" method="POST">
                @csrf
                <label for="content">返信する</label>
                <input type="text" name="content">
                <input type="submit">
            </form>
       </div>
    </div>
@endsection
