@extends('components.main')
@section('content')
    <div class="container d-flex flex-column justify-content-between" style="min-height: 100vh;">
        <div>

            <div class="d-flex align-items-center justify-content-center mb-3">
                <div class="form-group w-30">
                    <label for="category">Categories</label>
                    <select class="form-select" id="category" name="category_id">
                        <option value="0">All</option>
                        @foreach ($categories as $category)
                            <option {{ $category->id == $currentSelected ? 'selected' : '' }} value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('post.sort', 0) }}" id="sortButton" class="btn btn-secondary mt-2">Sort</a>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-center">
                <div style="max-width: 400px; word-wrap: break-word;">
                    @foreach ($posts as $post)
                        <div class="d-flex justify-content-center">
                            <strong>{{ $post->name }}</strong>
                        </div>
                        <br>
                        {{ $post->content }} <br>
                        Price: {{ $post->price }} <br>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary mb-4">See</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4" style="margin-bottom: 60px;">
            {{ $posts->withQueryString()->onEachSide(1)->links() }}
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
