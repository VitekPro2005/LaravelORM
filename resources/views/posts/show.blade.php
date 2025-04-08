@extends('layouts.main')

@section('posts')

    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>

    @if ($category)
        <p>Категория: {{ $category->name }}</p>
    @endif
    <p>
    <a href="{{ route('posts.edit', $post->id) }}">Изменить</a>
    </p>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить</button>
    </form>

@endsection
