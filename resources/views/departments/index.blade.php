@extends('layouts.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>{{ trans('main.users.departments') }}</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <button onclick="createDepartment()" type="button" class="btn btn-success" data-toggle="modal" data-target="#addDepartmentModal">
                    <i class="fas fa-plus mr-1"></i>
                </button>

                <div class="mt-3">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
    @include('departments.change')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

<script>
    function createDepartment() {
        document.getElementById('departmentNameInput').value = '';
        document.getElementById('confirmChangeDepartmentButton').textContent = 'Добавить'; //RU
    }
</script>
