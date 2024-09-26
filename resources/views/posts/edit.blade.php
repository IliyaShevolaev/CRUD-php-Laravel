@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <form action="{{ route('post.update', $post->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Название</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Введите название" value="{{$post->name}}">
            </div>

            <div class="form-group">
                <label for="content">Описание</label>
                <textarea name="content" class="form-control" id="content" placeholder="Что вы продаете">{{$post->content}}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input name="price" type="number" class="form-control" id="price" placeholder="Введите цену" value="{{$post->price}}">
            </div>

            <button type="submit" class="m-4 btn btn-primary">Редактировать</button>
            <a class="btn btn-primary" href="{{route('post.show', $post->id)}}">Назад</a>

        </form>
    </div>
@endsection