<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{route('post.index')}}"> Объявления</a>
            <a class="nav-item nav-link" href="{{route('post.create')}}">Создать объявление</a>
            <a class="nav-item nav-link" href="/about">Про нас</a>
          </div>
        </div>
      </nav>

    @yield('content')
</body>

</html>
