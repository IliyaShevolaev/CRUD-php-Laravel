@extends('components.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>Список пользователей</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    @endsection

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
