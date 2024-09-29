@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Введите название">
            </div>

            <div class="form-group">
                <label for="content">Описание</label>
                <textarea name="content" class="form-control" id="content" placeholder="Что вы продаете"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input name="price" type="number" class="form-control" id="price" placeholder="Введите цену">
            </div>

            <div class="form-group mt-3">
                <label for="category">Категория товара</label>
                <select class="form-select" id="category", name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="m-4 btn btn-primary">Опубликовать</button>

        </form>
    </div>
@endsection
