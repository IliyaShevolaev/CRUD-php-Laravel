@component('components.modal-window')
    @slot('modalId')
        addDepartmentModal
    @endslot
    @slot('modalTitle')
        <p id="departmentsModalHeader">{{ trans('main.users.add_department_header') }}</p>
    @endslot

    <div>
        <div class="form-group">
            <form id="changeDepartmentForm">
                <input name="name" type="text" class="form-control" id="departmentNameInput"
                    placeholder="{{ trans('main.title_placeholder') }}">
                <input name="method" type="hidden" id="departmentMethodInput">
                <input name="department_id" type="hidden" id="departmentIdInput">
                <p class="text-danger" id="departmentNameError"></p>
            </form>
        </div>
    </div>

    @slot('footer')
        <button id="confirmChangeDepartmentButton" type="button" class="btn btn-primary w-100">
            {{ trans('main.add_button') }}
        </button>
    @endslot
@endcomponent

<script>
    document.getElementById('confirmChangeDepartmentButton').addEventListener('click', function() {
        const form = document.getElementById('changeDepartmentForm');
        const formBody = new FormData(form);

        let fetchUrl = '';
        if (formBody.get('method') === 'POST') {
            fetchUrl = '/departments';
        } else {
            formBody.append('_method', 'PATCH');
            fetchUrl = `/departments/${formBody.get('department_id')}`;
        }
        formBody.delete('department_id')
        formBody.delete('method');

        fetch(fetchUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formBody
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
    });
</script>
