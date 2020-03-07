@extends('layout')
@inject('methods','App\Methods\Methods')

@section('content')
    <h1>post Index</h1>
    <div class="u-mt-30">
        <ul>
            @foreach ($posts as $post)
                <li>
                    <dl>
                        <dt><a href="{{route('user.index', ['user' => $post->user_id])}}">投稿者ページへ</a></dt>
                        <dt>{{ $post->title }}</dt>
                        @if ($post->image_url)
                            <dd><img src="{{ $post->image_url }}"></dd>
                        @endif
                        <dd>{{ $post->created_at }}</dd>
                        <dd>{{ $post->update_at }}</dd>
                        <a><a href="{{ route('posts.detail', ['post' => $post]) }}">詳細</a></a>
                        <div>
                            @if ( $methods->is_favorite($post->id))
                                <form action="{{ route('favorites.unfavorite',['post' => $post->id]) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit">いいね解除
                                </form>
                            @else
                                <form action="{{ route('favorites.favorite',['post' => $post->id]) }}" method="POST">
                                    @csrf
                                    <input type="submit">いいね登録
                                </form>
                            @endif
                        </div>
                    </dl>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="u-mt-30"><a href="{{ route('posts.create')}}">投稿を作成する</a></div>
@endsection
