@extends('layout')

@section('content')
    <h1>Hello! World!</h1>
    <a href="{{ route('posts.index') }}">Go to posts.index</a>
@endsection
