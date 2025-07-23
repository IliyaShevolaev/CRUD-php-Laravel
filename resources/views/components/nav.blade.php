<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">Мой профиль</a>
                    <a class="dropdown-item" href="{{ route('post.myPosts') }}">Мои посты</a>
                    <a class="dropdown-item" href="{{ route('like.show') }}">Избранное</a>
                </div>
            </li>
        </ul>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Посты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.create') }}">Создать пост</a>
                </li>
                @can('viewAdmin', auth()->user())
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('admin.') }}">Admin</a>
                    </li>
                @endcan
            </ul>

            <form action="{{ route('post.find') }}" method="GET" class="form-inline my-2 my-lg-0 mx-3">
                @csrf
                <input name="findQuery" class="form-control mr-sm-2" type="search" placeholder="Поиск">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
            </form>

            <form action="{{ route('login.logout') }}" method="POST" class="form-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Выход</button>
            </form>
        </div>
    </div>
</nav>
