@extends('components.admin-layout')

@section('title', 'Admin panel')

@section('content_header')

@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-3 card shadow-sm">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold">ID:</label>
                            <p class="form-control-plaintext">{{ $user->id }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold">Username:</label>
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold">Email:</label>
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                        <div class="text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
