<div class="d-flex justify-content-between">
    <button onclick="editDepartment({{ $department->id }}, '{{ $department->name }}')" class="btn btn-sm btn-warning"
        data-toggle="modal" data-target="#addDepartmentModal">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </button>

    <button onclick="deleteRow({{ $department->id }}, '{{ $department->name }}')"
        class="btn btn-sm btn-danger delete-btn">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    //с add надо так же по onclick
    function editDepartment(id, name) {
        document.getElementById('departmentNameInput').value = name;
        document.getElementById('confirmChangeDepartmentButton').textContent = 'Изменить'; //RU
        document.getElementById('confirmChangeDepartmentButton').onclick = function() {
            fetch(`/departments/${id}`, {
                method: 'PATCH',
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
                    const table = window.LaravelDataTables['departments-table'];
                    table.ajax.reload();

                    document.getElementById('departmentNameError').textContent = '';

                } else if (response.status === 422) {
                    return response.json().then(data => {
                        document.getElementById('departmentNameError').textContent = data.message;
                    });
                }
            });
        };
    }

    function deleteRow(id, name) {
        let confirmed = confirm(`Удалить отдел ${name}?`);

        if (confirmed) {
            fetch(`/departments/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.status === 200) {
                    const table = window.LaravelDataTables['departments-table'];
                    table.ajax.reload();
                }
            });
        }
    }
</script>
