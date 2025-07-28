@component('components.modal-window')
    @slot('modalId')
        addPositionModal
    @endslot
    @slot('modalTitle')
        <p id="positionsModalHeader">{{ trans('main.users.add_position_header') }}</p>
    @endslot

    <div>
        <div class="form-group">
            <form id="changePositionForm">
                <input name="name" type="text" class="form-control" id="positionNameInput"
                    placeholder="{{ trans('main.title_placeholder') }}">
                <input name="method" type="hidden" id="positionMethodInput">
                <input name="position_id" type="hidden" id="positionIdInput">
                <p class="text-danger" id="positionNameError"></p>
            </form>
        </div>
    </div>

    @slot('footer')
        <button id="confirmChangePositionButton" type="button" class="btn btn-primary w-100">
            {{ trans('main.add_button') }}
        </button>
    @endslot
@endcomponent

<script>
    document.getElementById('confirmChangePositionButton').addEventListener('click', function() {
        const form = document.getElementById('changePositionForm');
        const formBody = new FormData(form);

        let fetchUrl = '';
        if (formBody.get('method') === 'POST') {
            fetchUrl = '/positions';
        } else {
            formBody.append('_method', 'PATCH');
            fetchUrl = `/positions/${formBody.get('position_id')}`;
        }
        formBody.delete('position_id')
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
                document.getElementById('positionNameInput').value = '';
                document.getElementById('positionNameError').textContent = '';
                const table = window.LaravelDataTables['positions-table'];
                table.ajax.reload();
            } else if (response.status === 422) {
                return response.json().then(data => {
                    document.getElementById('positionNameError').textContent = data.message;
                });
            }
        });
    });
</script>
