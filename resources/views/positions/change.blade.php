@component('components.modal-window')
    @slot('modalId')
        addPositionModal
    @endslot
    @slot('modalTitle')
        <p id="positionsModalHeader">{{ trans('main.users.add_position_header') }}</p>
    @endslot

    <span id="form-placeholder"></span>
@endcomponent

@push('scripts')
    <script>
        $(document).on('submit', '#changePositionForm', function(event) {
            event.preventDefault();

            const currentForm = $('#changePositionForm');
            const formBody = new FormData(currentForm.get(0));

            $.ajax({
                method: 'POST',
                url: currentForm.attr('action'),
                processData: false,
                contentType: false,
                data: formBody,
                success: function(data) {
                    window.LaravelDataTables['positions-table'].ajax.reload();
                    bootstrap.Modal.getInstance($('#addPositionModal')).hide();
                },
                error: function(jqXHR) {
                    const errorsMessages = JSON.parse(jqXHR.responseText).errors;
                    if (jqXHR.status === 422) {
                        for (let fieldName in errorsMessages) {
                            $('#changePositionForm')
                                .find(`[data-field-${fieldName}]`)
                                .find('p')
                                .text(errorsMessages[fieldName])
                            $('#changePositionForm')
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
