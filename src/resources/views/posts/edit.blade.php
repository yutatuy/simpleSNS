@extends('layout')

@section('content')
    <h1>post edit</h1>
    <div class="u-mt-30">
        <form action="{{ route('posts.edit',['post' => $post]) }}" method="POST">
            @csrf
            <ul>
                <li>
                    <label for="title">タイトル</label>
                    <input type="text" name="title"><label for="title">
                </li>
            </ul>
            <button type="submit">送信</button>
        </form>
    </div>
@endsection
