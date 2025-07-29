<div class="d-flex justify-content-between">
    <button onclick="editDepartment({{ $department->id }}, '{{ $department->name }}')" class="btn btn-sm btn-warning">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </button>

    <button onclick="deleteRow({{ $department->id }}, '{{ $department->name }}')"
        class="btn btn-sm btn-danger delete-btn">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    function editDepartment(id, name) {
        $('#departmentsModalHeader').text('{{ trans('main.users.edit_department_header') }}');

        $.ajax({
            method: 'GET',
            url: '{{ route('departments.edit', ':id') }}'.replace(':id', id),
            success: function(data) {
                $('#addDepartmentModal').find('#form-placeholder').empty().append(data)
                new bootstrap.Modal($('#addDepartmentModal')).show();
            },
            error: function(jqXHR) {
                if (jqXHR.status === 404) {
                    alert('{{ trans('main.id_not_found') }}');
                } else {
                    console.log(jqXHR);
                }
            }
        });
    }

    function deleteRow(id, name) {
        let confirmed = confirm(`{{ trans('main.users.delete_department_alert') }} ${name}?`);

        if (confirmed) {
            $.ajax({
                method: 'DELETE',
                url: `{{ route('departments.destroy', ':id') }}`.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                success: function(data) {
                    const table = window.LaravelDataTables['departments-table'];
                    table.ajax.reload();
                },
                error: function(jqXHR) {
                    if (jqXHR.status === 409) {
                        alert('{{ trans('main.users.not_allowed_to_delete_department_alert') }}');
                    } else if (jqXHR.status === 404) {
                        alert('{{ trans('main.id_not_found') }}');
                    } else {
                        console.log(jqXHR);
                    }
                }
            });
        }
    }
</script>
