@extends('components.lte-layout')
@section('content')
    <div class="mt-3 col-md-6 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Добавить пользователя</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input value="{{ $user->name }}" name="name" type="text" class="form-control" id="name"
                            placeholder="Введите имя">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Почта</label>
                        <input value="{{ $user->email }}" name="email" type="email" class="form-control" id="email"
                            placeholder="Введите почту">

                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="role">Роль</label>
                        <select value="{{ $user->role }}" class="form-control select2bs4" id="role", name="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Пароль</label>
                        <input value="{{ old('password') }}" name="password" type="password" class="form-control"
                            id="password" placeholder="Введите пароль">

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Подтверждение пароля</label>
                        <input value="{{ old('password_confirmation') }}" name="password_confirmation" type="password"
                            class="form-control" id="password_confirmation" placeholder="Введите пароль">

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-warning w-50">Изменить</button>
                        <a href="{{ url()->previous() }}" type="submit" class="btn btn-danger w-50">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="card card-primary mt-3 w-25 mx-auto">
        <div class="card-header">
            <h3>Изменить пользователя</h3>
        </div>
        <div class="card-body">
            <div class="container d-flex align-items-center justify-content-center">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input value="{{ $user->name }}" name="name" type="text" class="form-control" id="name"
                            placeholder="Введите имя">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Почта</label>
                        <input value="{{ $user->email }}" name="email" type="email" class="form-control" id="email"
                            placeholder="Введите почту">

                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="role">Роль</label>
                        <select value="{{ $user->role }}" class="form-control select2bs4" id="role", name="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Пароль</label>
                        <input value="{{ old('password') }}" name="password" type="password" class="form-control"
                            id="password" placeholder="Введите пароль">

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Подтверждение пароля</label>
                        <input value="{{ old('password_confirmation') }}" name="password_confirmation" type="password"
                            class="form-control" id="password_confirmation" placeholder="Введите пароль">

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-100 btn btn-warning">Изменить</button>
                </form>
            </div>
        </div> --}}
@endsection
