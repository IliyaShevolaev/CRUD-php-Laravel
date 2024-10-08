@extends('components.main')
@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="id">ID</label>
                <input value="{{ auth()->user()->id }}" type="text" class="form-control" id="id" disabled>

            </div>

            <div class="form-group">
                <label for="name">Username</label>
                <input value="{{ $owner->name }}" name="name" type="text" class="form-control"
                    id="name">

                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Email</label>
                <input value="{{ $owner->email }}" name="email" type="text" class="form-control"
                    id="email">

                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label for="inputPassword">Password</label>
                <input name="password" type="password" class="form-control" id="inputPassword2" placeholder="Password">

                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div> --}}

            <button type="submit" class="m-4 btn btn-primary">Редактировать</button>

        </form>
    </div>
@endsection
