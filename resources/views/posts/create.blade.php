@extends('components.lte-layout')
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3>Создать пост</h3>
        </div>
        <div class="card-body">
            <div class="container d-flex align-items-center justify-content-center">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="name"
                            placeholder="Введите имя">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Описание</label>
                        <textarea name="content" class="form-control" id="content" placeholder="Введите описание">{{ old('content') }}</textarea>

                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input value="{{ old('price') }}" name="price" type="number" class="form-control" id="price"
                            placeholder="Введите цену">

                        @error('price')
                            <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="category">Категория</label>
                        <select class="form-control select2bs4" id="category", name="category_id">
                            @foreach ($categories as $category)
                                <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="m-4 btn btn-primary">Опубликовать</button>
                </form>
            </div>
        </div>
    </div>
@endsection
