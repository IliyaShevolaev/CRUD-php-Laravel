@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <div>
            <div class="mb-3">
                <h4>{{ $post->name }}</h4>
                <p>{{ $post->content }}</p>
                <p>Цена: {{ $post->price }} рублей</p>
                <p>От: {{$post->updated_at}}</p>
            </div>

            <div class="d-flex flex-wrap mb-4">
                <a href="{{ route('post.index') }}" class="btn btn-primary me-2 mb-2">Назад</a>

                <form action="{{ route('post.delete', $post->id) }}" method="POST" class="me-2 mb-2">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Удалить" class="btn btn-danger">
                </form>

                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning me-2 mb-2">Редактировать</a>

                <a href="#" class="btn btn-success me-2 mb-2">Оформить</a>
            </div>
        </div>
    </div>
@endsection
