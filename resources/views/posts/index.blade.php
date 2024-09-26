@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <h1>Posts</h1>
    </div>

    <div class="container d-flex align-items-center justify-content-center">
        <div>
            @foreach ($posts as $post)
                {{ $post->name }} <br>
                {{ $post->content }} <br>
                Цена: {{ $post->price }}

                <div><a href="{{route('post.show', $post->id)}}" class="btn btn-primary mb-3">Перейти</a></div>
            @endforeach
        </div>
    </div>
@endsection
