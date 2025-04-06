@extends('layouts.main')

@section('posts')

<h1>Блог</h1>

<a href="{{ route('posts.create') }}">Новый пост</a>
<a href="{{ route('posts.download') }}">Скачать все посты в JSON</a>

@foreach ($posts as $id => $post)
    <a href="{{ route('posts.show', $id) }}"><h2>{{ $post }}</h2></a>

@endforeach

@endsection
