@extends('layouts.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>{{ trans('main.users.departments') }}</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <button onclick="createDepartment()" type="button" class="btn btn-success">
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

    <script>
        function createDepartment() {
        $('#departmentsModalHeader').text('{{ trans('main.users.add_department_header') }}');

            $.ajax({
                method: 'GET',
                url: "{{ route('departments.create') }}",
                success: function(data) {
                    $('#addDepartmentModal').find('#form-placeholder').empty().append(data)
                    new bootstrap.Modal($('#addDepartmentModal')).show();
                }
            });
        }
    </script>
@endpush
