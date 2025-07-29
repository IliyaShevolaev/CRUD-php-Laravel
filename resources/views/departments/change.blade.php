@component('components.modal-window')
    @slot('modalId')
        addDepartmentModal
    @endslot
    @slot('modalTitle')
        <p id="departmentsModalHeader">{{ trans('main.users.add_department_header') }}</p>
    @endslot

    <span id="form-placeholder"></span>
@endcomponent

@push('scripts')
    <script>
        $(document).on('submit', '#changeDepartmentForm', function(event) {
            event.preventDefault();

            const currentForm = $('#changeDepartmentForm');
            const formBody = new FormData(currentForm.get(0));

            $.ajax({
                method: 'POST',
                url: currentForm.attr('action'),
                processData: false,
                contentType: false,
                data: formBody,
                success: function(data) {
                    window.LaravelDataTables['departments-table'].ajax.reload();
                    bootstrap.Modal.getInstance($('#addDepartmentModal')).hide();
                },
                error: function(jqXHR) {
                    const errorsMessages = JSON.parse(jqXHR.responseText).errors;
                    
                    if (jqXHR.status === 422) {
                        for (let fieldName in errorsMessages) {
                            $('#changeDepartmentForm')
                                .find(`[data-field-${fieldName}]`)
                                .find('p')
                                .text(errorsMessages[fieldName])
                            $('#changeDepartmentForm')
                                .find(`[data-field-${fieldName}]`)
                                .find('input')
                                .addClass('is-invalid')
                        }
                    } else if (jqXHR.status === 404) {
                        alert('{{ trans('main.id_not_found') }}');
                    } else {
                        console.log(jqXHR);
                    }
                }
            });
        });
    </script>
@endpush
