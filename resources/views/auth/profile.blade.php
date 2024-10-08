@extends('components.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold">ID:</label>
                            <p class="form-control-plaintext">{{ $owner->id }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold">Username:</label>
                            <p class="form-control-plaintext">{{ $owner->name }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold">Email:</label>
                            <p class="form-control-plaintext">{{ $owner->email }}</p>
                        </div>
                        <div class="text-center">
                            <a href="{{url()->previous()}}" class="btn btn-primary">Назад</a>
                            @can('viewEditProfile', $owner)
                            <a href="{{route('profile.edit', $owner->id)}}" class="{{auth()->user()->role == 'admin' && $owner->id != auth()->id() ? "btn btn-outline-danger" : "btn btn-primary"}}">Редактировать</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
