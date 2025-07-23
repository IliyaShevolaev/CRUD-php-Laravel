<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Laravel</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item" href="{{route('profile.index')}}">Мой профиль</a></li>
                          <li><a class="dropdown-item" href="{{route('post.myPosts')}}">Мои посты</a></li>
                          <li><a class="dropdown-item" href="{{route('like.show')}}">Избранное</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>

                <a class="nav-item nav-link" href="{{ route('post.index') }}"> Посты</a>
                <a class="nav-item nav-link" href="{{ route('post.create') }}">Создать пост</a>
                @can('viewAdmin', auth()->user())
                    <a class="nav-item nav-link text-danger" href="{{ route('admin.') }}">Admin</a>
                @endcan
            </div>
            <form action="{{ route('post.find') }}" method="GET" class="d-flex ms-auto me-3">
                @csrf
                <input name="findQuery" class="form-control me-2" type="search" placeholder="Поиск">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
            </form>
            <form action="{{ route('login.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger me-3">Выход</button>
            </form>
        </div>
    </nav>

    @yield('content')
</body>

</html>
