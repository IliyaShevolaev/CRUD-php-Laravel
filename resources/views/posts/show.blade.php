@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <div>
            @foreach ($posts as $post)
                {{ $post->name }} <br>
                {{ $post->content }} <br>
                Цена: {{ $post->price }}

                <div>
                    <a href="{{ route('post.index') }}" class="btn btn-primary mb-3">Назад</a>
                </div>

                <div>
                    <a href="#" class="btn btn-success mb-3">Оформить</a>
                </div>

                <div>
                    <form action="{{route('post.delete', $post->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Удалить" class="btn btn-danger mb-3">
                    </form>
                    <a href="{{route('post.edit', $post->id)}}" class="btn btn-warning mb-3">Редактировать</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
