@extends('layouts.main')

@section('posts')

    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    @if ($category)
        <p>Категория: {{ $category->name }}</p>
    @endif

    <a href="{{ route('posts.edit', $post->id) }}">Изменить</a>

@endsection
