@extends('components.lte-layout')
@section('content')
    <div class="mt-3 col-md-6 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Добавить пользователя</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="name"
                            placeholder="Введите имя">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Почта</label>
                        <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="email"
                            placeholder="Введите почту">

                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
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

                    <div class="form-group mt-3">
                        <label for="role">Роль</label>
                        <select class="form-control select2bs4" id="category", name="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-success w-50">Добавить</button>
                        <a href="{{ url()->previous() }}" type="submit" class="btn btn-danger w-50">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
