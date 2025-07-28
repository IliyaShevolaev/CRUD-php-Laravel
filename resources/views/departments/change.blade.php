@component('components.modal-window')
    @slot('modalId')
        addDepartmentModal
    @endslot
    @slot('modalTitle')
        <p id="departmentsModalHeader">{{ trans('main.users.add_department_header') }}</p>
    @endslot

    <div>
        <div class="form-group">
            <input type="text" class="form-control" id="departmentNameInput"
                placeholder="{{ trans('main.title_placeholder') }}">
            <p class="text-danger" id="departmentNameError"></p>
        </div>
    </div>

    @slot('footer')
        <button onclick="" id="confirmChangeDepartmentButton" type="button" class="btn btn-primary w-100">
            {{ trans('main.add_button') }}
        </button>
    @endslot
@endcomponent

<script>

</script>
