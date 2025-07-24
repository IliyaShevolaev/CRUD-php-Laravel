@extends('components.lte-layout')
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3>{{$post->name}}</h3>
        </div>
        <div class="card-body">
            <div class="container d-flex align-items-center justify-content-center">
                <div>
                    <div class="mb-3">
                        <h4>{{ $post->name }}</h4>
                        <p>{{ $post->content }}</p>
                        <p>Цена: {{ $post->price }} </p>
                        <p>Категория: {{ $category->name }}</p>
                        <p>От: {{ $post->created_at }}</p>
                    </div>

                    <div class="d-flex flex-wrap mb-4 gap-3">
                        <a href="{{ url()->previous() }}" class="btn btn-primary mr-3">Назад</a>

                        @can('delete', $post)
                            <form action="{{ route('post.delete', $post->id) }}" method="POST"
                                class=">
                            @csrf
                            @method('delete')
                            <input type="submit"
                                value="Удалить" class="btn btn-danger mr-3">
                            </form>
                        @endcan

                        @can('update', $post)
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning mr-3">Редактировать</a>
                        @endcan

                        @if (!$isAdminView)
                            <a href="{{ route('post.view-owner', $post) }}" class="btn btn-success mr-3">Заказать</a>

                            <form action="{{ route('like.create') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit"
                                    class="{{ $liked ? 'btn btn-success' : ' btn btn-outline-success' }}">
                                    Избаранное: {{ $post->likes }}
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endsection
