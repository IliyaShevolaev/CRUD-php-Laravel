@component('components.modal-window')
    @slot('modalId')
        addDepartmentModal
    @endslot
    @slot('modalTitle')
        {{ str(trans('main.users.add_department_header'))->ucfirst() }}
    @endslot

    <div>
        <div class="form-group">
            <input type="text" class="form-control" id="departmentNameInput"
                placeholder="{{ trans('main.title_placeholder') }}">
            <p class="text-danger" id="departmentNameError"></p>
        </div>
    </div>

    @slot('footer')
        <button onclick="storeDepartment()" id="confirmChangeDepartmentButton" type="button" class="btn btn-primary w-100">
            {{ trans('main.add_button') }}
        </button>
    @endslot
@endcomponent

<script>
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

}
</script>
