<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Торговая площадка</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{ route('post.index') }}"> Объявления</a>
                <a class="nav-item nav-link" href="{{ route('post.create') }}">Создать объявление</a>
                <a class="nav-item nav-link" href="/about">Про нас</a>
            </div>
            <form action="{{route('post.find')}}" method="GET" class="d-flex ms-auto me-3">
              @csrf
                <input name="findQuery" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a href="{{route('login')}}" class="btn btn-outline-danger me-3">Log out</a>
        </div>
    </nav>

    @yield('content')
</body>

</html>
