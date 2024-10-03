@extends('components.auth-nav')
@section('content')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <div class="d-flex justify-content-center align-items-center vh-100"
        style="background: linear-gradient(135deg, #0a0a0a, #0b1e36); background-size: cover; background-position: center;">
        <form action="{{ route('login.store') }}" method="POST" NOVALIDATE
            style="max-width: 400px; width: 100%; background-color: #1c1c1c; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-light">Email address</label>
                <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                @error('incorrectEmail')
                    <p class="text-danger"> User with this email does not exist</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label text-light">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">

                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                @error('wrongPassword')
                <p class="text-danger"> Wrong password </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-outline-primary w-100">Log in</button>
        </form>
    </div>
@endsection
