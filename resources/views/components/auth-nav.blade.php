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

        <a href="{{ route('auth.register') }}" class="btn btn-outline-success mx-4">Register</a>
        <a href="{{ route('auth.login') }}" class="btn btn-outline-success ml-3">Log In</a>

    </nav>

    @yield('content')
</body>

</html>
