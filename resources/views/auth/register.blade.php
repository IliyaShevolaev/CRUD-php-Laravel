@extends('adminlte::auth.register')

@section('auth_header', 'Регистрация')

@section('auth_body')
    <form action="{{ route('register.store') }}" method="POST" NOVALIDATE>
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">

            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Имя</label>
            <input value="{{ old('userName') }}" name="userName" type="text" class="form-control" id="exampleInputName">

            @error('userName')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">

            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Подтвердите пароль</label>
            <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2">

            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary w-100">Регистрация</button>
    </form>
@endsection

@section('auth_footer')
    <a href="{{ route('login') }}">Вход</a>
@endsection
