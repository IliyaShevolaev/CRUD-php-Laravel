@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <h1>Posts</h1>
    </div>

    </div>

    <div class="container d-flex align-items-center justify-content-center mb-3">
        <div class="form-group w-30">
            <label for="category">Категория товара</label>
            <select class="form-select" id="category" name="category_id">
                <option value="0">Все товары</option>
                @foreach ($categories as $category)
                    <option {{$category->id == $currentSelected ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->name}}
                    </option>
                @endforeach
            </select>
    
            <div>
                <a href="{{ route('post.sort', 0) }}" id="sortButton" class="btn btn-secondary mt-2">Сортировать</a>
            </div>
        </div>
    </div>

    <div class="container d-flex align-items-center justify-content-center">

        <div>
            @foreach ($posts as $post)
                {{ $post->name }} <br>
                {{ $post->content }} <br>
                Цена: {{ $post->price }}

                <div><a href="{{ route('post.show', $post->id) }}" class="btn btn-primary mb-3">Перейти</a></div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            const selectedValue = this.value;
            const sortButton = document.getElementById('sortButton');
    
            const baseUrl = "{{ url('posts/sort') }}";
    
            sortButton.href = `${baseUrl}/${selectedValue}`;
        });
    </script>
@endsection
