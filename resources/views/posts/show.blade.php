@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <div>
            <div class="mb-3">
                <h4>{{ $post->name }}</h4>
                <p>{{ $post->content }}</p>
                <p>Цена: {{ $post->price }} рублей</p>
                <p>Тип: {{ $category->name }}</p>
                <p>От: {{ $post->created_at }}</p>
            </div>

            <div class="d-flex flex-wrap mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-primary me-2 mb-2">Назад</a>

                @can('delete', $post)
                    <form action="{{ route('post.delete', $post->id) }}" method="POST" class="me-2 mb-2">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Удалить" class="btn btn-danger">
                    </form>
                @endcan

                @can('update', $post)
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning me-2 mb-2">Редактировать</a>
                @endcan

                <a href="{{ route('post.view-owner', $post) }}" class="btn btn-success me-2 mb-2">Оформить</a>

                <form action="{{ route('like.create') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="{{ $liked ? 'btn btn-success' : ' btn btn-outline-success me-2 mb-2' }}">
                        Likes: {{$post->likes}}
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
