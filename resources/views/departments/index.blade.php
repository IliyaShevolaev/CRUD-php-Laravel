@extends('layouts.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>{{ trans('main.users.departments') }}</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <button onclick="createDepartment()" type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#addDepartmentModal">
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
        document.getElementById('departmentNameError').textContent = '';
        document.getElementById('confirmChangeDepartmentButton').textContent = '{{ trans('main.add_button') }}';
        document.getElementById('departmentsModalHeader').textContent =
            '{{ trans('main.users.add_department_header') }}';
        document.getElementById('confirmChangeDepartmentButton').onclick = function() {
            fetch(`/departments`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name: document.getElementById('departmentNameInput').value.trim()
                })
            }).then(response => {
                if (response.status === 200) {
                    document.getElementById('departmentNameInput').value = '';
                    document.getElementById('departmentNameError').textContent = '';
                    const table = window.LaravelDataTables['departments-table'];
                    table.ajax.reload();
                } else if (response.status === 422) {
                    return response.json().then(data => {
                        document.getElementById('departmentNameError').textContent = data.message;
                    });
                }
            });
        };
    }
</script>
