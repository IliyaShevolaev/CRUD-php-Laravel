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
        $.ajax({
            method: 'GET',
            url: '{{ route("departments.edit", ":id") }}'.replace(':id', id),
            dataType: 'json',
            success: function(data) {
                $('#addDepartmentModal').find('.form-group').empty().append(data)
                new bootstrap.Modal($('#addDepartmentModal')).show();
            }
        });
    }

    function deleteRow(id, name) {
        let confirmed = confirm(`{{ trans('main.users.delete_department_alert') }} ${name}?`);

        if (confirmed) {
            fetch(`/departments/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.status === 200) {
                    const table = window.LaravelDataTables['departments-table'];
                    table.ajax.reload();
                } else if (response.status === 409) {
                    alert('{{ trans('main.users.not_allowed_to_delete_department_alert') }}');
                } else if (response.status === 404) {
                    alert('{{ trans('main.id_not_found') }}');
                }
            }).catch(error => {
                console.log(error);
                alert('error');
            });
        }
    }
</script>
