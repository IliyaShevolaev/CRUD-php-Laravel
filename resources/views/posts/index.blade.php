@extends($adminLteLayout)
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3>Список постов</h3>
        </div>
        <div class="card-body">
            <div class="container d-flex flex-column justify-content-between" style="min-height: 100vh;">
                <div>
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="form-group w-30">
                            <label for="category">Категории</label>
                            <select class="form-control select2bs4" id="category" name="category_id">
                                <option value="0">Все</option>
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $currentSelected ? 'selected' : '' }}
                                        value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="d-flex justify-content-center">
                                <a href="{{ route('post.sort', 0) }}" id="sortButton"
                                    class="btn btn-secondary mt-2">Найти</a>
                            </div>
                        </div>
                    </div>

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
                                            <a href="{{ route('post.show', $post->id) }}"
                                                class="btn btn-primary">Перейти</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4" style="margin-bottom: 60px;">
                    {{ $posts->withQueryString()->onEachSide(1)->links() }}
                </div>
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
