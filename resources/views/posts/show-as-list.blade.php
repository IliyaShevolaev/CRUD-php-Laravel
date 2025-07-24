@extends('components.lte-layout')
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3>Выбранные посты</h3>
        </div>
        <div class="card-body">
            <div class="container d-flex flex-column justify-content-between" style="min-height: 100vh;">
                <div>
                    <div class="d-flex align-items-center justify-content-center">
                        <div style="width: 700px">
                            @foreach ($posts as $post)
                                <div class="card card-primary mt-2">
                                    <div class="card-header">
                                        <strong>{{ $post->name }}</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $post->content }}</p>
                                        <p>Цена: {{ $post->price }}</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary ">
                                                Перейти</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
