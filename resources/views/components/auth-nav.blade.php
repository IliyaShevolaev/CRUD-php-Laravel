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

        <a href="{{ route('register') }}" class="btn btn-outline-success mx-4">Регистрация</a>
        <a href="{{ route('login') }}" class="btn btn-outline-success ml-3">Вход</a>

    </nav>

    @yield('content')
</body>

</html>
