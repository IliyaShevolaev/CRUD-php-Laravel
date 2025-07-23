@extends('components.main')
@section('content')
    <div class="container d-flex flex-column justify-content-between" style="min-height: 100vh;">
        <div>
            <div class="d-flex align-items-center justify-content-center">
                <div style="max-width: 400px; word-wrap: break-word;">
                    @foreach ($posts as $post)
                        <div class="d-flex justify-content-center">
                            <strong>{{ $post->name }}</strong>
                        </div>
                        <br>
                        {{ $post->content }} <br>
                        Цена: {{ $post->price }} <br>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary mb-4">Перейти</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
