@component('components.modal-window')
    @slot('modalId')
        addDepartmentModal
    @endslot
    @slot('modalTitle')
        {{ str(trans('main.users.departments'))->ucfirst() }}
    @endslot

    <div>
        <div id="departmentsContent">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="departmentNameInput"
                placeholder="{{ trans('main.title_placeholder') }}">
            <p class="text-danger" id="departmentNameError"></p>
        </div>
    </div>

    @slot('footer')
        <button onclick="storeDepartment()" type="button" class="btn btn-primary w-100">{{ trans('main.add_button') }}</button>
    @endslot
@endcomponent

<script>
    function loadDepartments() {
        fetch(`/departments`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            const departmentsContent = document.getElementById('departmentsContent');

            if (data.data && data.data.length > 0) {
                let html = '<ul class="list-group">';
                data.data.forEach(department => {
                    html += `
                        <li class="list-group-item d-flex justify-content-between">
                            ${department.name}

                            <div>
                                <button class="btn btn-warning" onclick=updateDepartment(${department.id})>
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-danger" onclick=deleteDepartment(${JSON.stringify(department)})>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                        `;
                });
                html += '</ul>';

                departmentsContent.innerHTML = html;
            }
        });
    }

    function storeDepartment() {
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
                loadDepartments();
                document.getElementById('departmentNameInput').value = '';
                document.getElementById('departmentNameError').textContent = '';
            } else if (response.status === 422) {
                return response.json().then(data => {
                    document.getElementById('departmentNameError').textContent = data.message;
                });
            }
        });
    }

    function updateDepartment(id) {
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
                loadDepartments();
                document.getElementById('departmentNameInput').value = '';
                document.getElementById('departmentNameError').textContent = '';
            } else if (response.status === 422) {
                return response.json().then(data => {
                    document.getElementById('departmentNameError').textContent = data.message;
                });
            }
        });
    }

    function deleteDepartment(department) {
        let confirmed = confirm(`Удалить отдел ${department.name}?`);

        if (confirmed) {
            fetch(`/departments/${department.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.status === 200) {
                    loadDepartments();

                    const table = window.LaravelDataTables['users-table'];
                    table.ajax.reload();
                }
            });
        }
    }

    loadDepartments();
</script>
