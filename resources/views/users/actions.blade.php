<div class="d-flex justify-content-between">
    <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user->id) }}">
        <i class="fa fa-lg fa-fw fa-pen"></i>
    </a>

    <button onclick="deleteRow({{ $user->id }}, '{{ $user->name }}')" class="btn btn-sm btn-danger delete-btn">
        <i class="fas fa-trash"></i>
    </button>
</div>

<script>
    function deleteRow(id, name) {
        let confirmed = confirm(`Удалить пользователя ${name}?`);

        if (confirmed) {
            fetch(`/admin/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(() => {
                const table = window.LaravelDataTables['users-table'];
                table.ajax.reload();
            })
        }
    }
</script>
