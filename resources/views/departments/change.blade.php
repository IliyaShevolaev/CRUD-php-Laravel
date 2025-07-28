@component('components.modal-window')
    @slot('modalId')
        addDepartmentModal
    @endslot
    @slot('modalTitle')
        <p id="departmentsModalHeader">{{ trans('main.users.add_department_header') }}</p>
    @endslot

    <div>
        <div class="form-group">
        </div>
    </div>
@endcomponent

{{-- <script>
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
</script> --}}
