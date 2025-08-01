@extends('layouts.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>{{ trans('main.users.list_header') }}</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <a class="btn btn-success" href="{{ route('users.create') }}">
                    <i class="fas fa-plus mr-1"></i>
                </a>

                <div class="mt-3">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
