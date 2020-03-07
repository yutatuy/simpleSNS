@extends('layout')

@section('content')
    <div class="u-mt-30">
        <h2>ユーザID：{{ $user_id }}の投稿↓</h2>
        <ul>
            @foreach ($posts as $post)
                <li>
                    <dl>
                        @if ($post->user_id == $user_id)
                            <dt>ユーザID：{{ $post->user_id }}</dt>
                            <dt>{{ $post->title }}</dt>
                            @if (!($post->image_url === 'aaa'))
                            <dd><img src="{{ $post->image_url }}" alt=""></dd>
                            @endif
                            <dd>{{ $post->created_at }}</dd>
                            <dd>{{ $post->update_at }}</dd>
                            <p><a href="{{ route('posts.detail', ['post' => $post]) }}">詳細</a></p>
                        @endif
                    </dl>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="u-mt-30"><a href="{{ route('posts.create')}}">投稿を作成する</a></div>
    <div class="u-mt-30">
        <a href="{{ route('posts.index') }}">Go to posts.index</a>
    </div>
@endsection
