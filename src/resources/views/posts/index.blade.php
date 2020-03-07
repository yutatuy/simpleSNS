@extends('layout')

@section('content')
    <h1>post Index</h1>
    <div class="u-mt-30">
        <ul>
            @foreach ($posts as $post)
                <li>
                    <dl>
                        <dt>{{ $post->title }}</dt>
                        <dd>{{ $post->created_at }}</dd>
                        <dd>{{ $post->update_at }}</dd>
                        <a><a href="{{ route('posts.detail', ['post' => $post]) }}">詳細</a></a>
                    </dl>
                </li>
            @endforeach
        </ul>
        <div class="u-mt-30"><a href="{{ route('posts.create')}}">投稿を作成する</a></div>
    </div>
@endsection
