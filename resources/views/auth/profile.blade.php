@extends('components.lte-layout')
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3>{{$owner->name}}</h3>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="fw-bold">ID:</label>
                <p class="form-control-plaintext">{{ $owner->id }}</p>
            </div>
            <div class="form-group mb-3">
                <label class="fw-bold">Имя:</label>
                <p class="form-control-plaintext">{{ $owner->name }}</p>
            </div>
            <div class="form-group mb-3">
                <label class="fw-bold">Почта:</label>
                <p class="form-control-plaintext">{{ $owner->email }}</p>
            </div>
        </div>
    @endsection
