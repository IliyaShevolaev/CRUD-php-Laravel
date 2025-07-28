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
        document.getElementById('positionNameError').textContent = '';
        document.getElementById('confirmChangePositionButton').textContent = '{{trans('main.edit_button')}}';
        document.getElementById('positionsModalHeader').textContent = '{{trans('main.users.edit_position_header')}}';
        document.getElementById('confirmChangePositionButton').onclick = function() {
            fetch(`/positions/${id}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name: document.getElementById('positionNameInput').value.trim()
                })
            }).then(response => {
                if (response.status === 200) {
                    const table = window.LaravelDataTables['positions-table'];
                    table.ajax.reload();

                    document.getElementById('positionNameError').textContent = '';

                } else if (response.status === 422) {
                    return response.json().then(data => {
                        document.getElementById('positionNameError').textContent = data.message;
                    });
                }
            });
        };
    }

    function deleteRow(id, name) {
        let confirmed = confirm(`{{trans('main.users.delete_position_alert')}} ${name}?`);

        if (confirmed) {
            fetch(`/positions/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.status === 200) {
                    const table = window.LaravelDataTables['positions-table'];
                    table.ajax.reload();
                }
            });
        }
    }
</script>
