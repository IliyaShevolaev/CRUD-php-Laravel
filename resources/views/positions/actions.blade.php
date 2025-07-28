<div class="d-flex justify-content-between">
    <button onclick="editPosition({{ $position->id }}, '{{ $position->name }}')" class="btn btn-sm btn-warning"
        data-toggle="modal" data-target="#addPositionModal">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </button>

    <button onclick="deleteRow({{ $position->id }}, '{{ $position->name }}')"
        class="btn btn-sm btn-danger delete-btn">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    function editPosition(id, name) {
        document.getElementById('positionNameInput').value = name;
        document.getElementById('positionMethodInput').value = 'PATCH';
        document.getElementById('positionIdInput').value = id;
        document.getElementById('positionNameError').textContent = '';
        document.getElementById('confirmChangePositionButton').textContent = '{{trans('main.edit_button')}}';
        document.getElementById('positionsModalHeader').textContent = '{{trans('main.users.edit_position_header')}}';
    }

    function deleteRow(id, name) {
        let confirmed = confirm(`{{trans('main.users.delete_position_alert')}} ${name}?`);

        if (confirmed) {
            fetch(`/positions/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.status === 200) {
                    const table = window.LaravelDataTables['positions-table'];
                    table.ajax.reload();
                } else if (response.status === 409) {
                    alert('{{trans('main.users.not_allowed_to_delete_position_alert')}}');
                } else if (response.status === 404) {
                    alert('{{ trans('main.id_not_found') }}');
                }
            });
        }
    }
</script>
