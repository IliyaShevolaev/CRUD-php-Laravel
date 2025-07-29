<div class="d-flex justify-content-between">
    <button onclick="editPosition({{ $position->id }}, '{{ $position->name }}')" class="btn btn-sm btn-warning">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </button>

    <button onclick="deleteRow({{ $position->id }}, '{{ $position->name }}')"
        class="btn btn-sm btn-danger delete-btn">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    function editPosition(id, name) {
        $('#positionsModalHeader').text('{{ trans('main.users.edit_position_header') }}');

        $.ajax({
            method: 'GET',
            url: '{{ route('positions.edit', ':id') }}'.replace(':id', id),
            success: function(data) {
                $('#addPositionModal').find('#form-placeholder').empty().append(data)
                new bootstrap.Modal($('#addPositionModal')).show();
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
        let confirmed = confirm(`{{ trans('main.users.delete_position_alert') }} ${name}?`);

        if (confirmed) {
            $.ajax({
                method: 'DELETE',
                url: `{{ route('positions.destroy', ':id') }}`.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                success: function(data) {
                    const table = window.LaravelDataTables['positions-table'];
                    table.ajax.reload();
                },
                error: function(jqXHR) {
                    if (jqXHR.status === 409) {
                        alert('{{ trans('main.users.not_allowed_to_delete_position_alert') }}');
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
