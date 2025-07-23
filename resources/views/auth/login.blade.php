@extends('adminlte::auth.login')

@section('auth_header', 'Вход')

@section('auth_body')
    <form action="{{ route('login.store') }}" method="POST" NOVALIDATE>
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Почта</label>
            <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">

            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            @error('incorrectEmail')
                <p class="text-danger"> Пользователя с такой почтой не существует</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">

            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror

            @error('wrongPassword')
                <p class="text-danger"> Неверный пароль </p>
            @enderror
        </div>

        <div class="mb-3 form-check d-flex flex-row">
            <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
            <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
        </div>

        <button type="submit" class="btn btn-outline-primary w-100">Войти</button>
    </form>
@endsection

@section('auth_footer')
    <a href="{{ route('register') }}">Регистрация</a>
@endsection
