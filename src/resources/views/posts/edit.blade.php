@extends('layout')

@section('content')
    <h1>post edit</h1>
    <div class="u-mt-30">
        <div>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{ route('posts.edit',['post' => $post]) }}" enctype="multipart/form-data" method="POST">
            @csrf
            <ul>
                <li>
                    <div>
                        <label for="title">タイトル</label>
                        <input type="text" name="title"><label for="title">
                    </div>
                    <div>
                        <input type="file" id="file" name="image_url" class="form-control">
                    </div>
                </li>
            </ul>
            <button type="submit">送信</button>
        </form>
    </div>
@endsection
