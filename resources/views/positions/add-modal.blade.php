@component('components.modal-window')
    @slot('modalId')
        addPositionModal
    @endslot
    @slot('modalTitle')
        {{ str(trans('main.users.positions'))->ucfirst() }}
    @endslot

    <div>
        <div id="positionsContent">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="positionNameInput"
                placeholder="{{ trans('main.title_placeholder') }}">
            <p class="text-danger" id="positionNameError"></p>
        </div>
    </div>

    @slot('footer')
        <button onclick="storePosition()" type="button" class="btn btn-primary w-100">{{ trans('main.add_button') }}</button>
    @endslot
@endcomponent

<script>
    function loadPositions() {
        fetch(`/positions`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            const positionsContent = document.getElementById('positionsContent');

            if (data.data && data.data.length > 0) {
                let html = '<ul class="list-group">';
                data.data.forEach(position => {
                    html += `
                        <li class="list-group-item d-flex justify-content-between">
                            ${position.name}
                            <div>
                                <button class="btn btn-warning" onclick=updatePosition(${position.id})>
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-danger" onclick=deletePosition(${JSON.stringify(position)})>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                        `;
                });
                html += '</ul>';

                positionsContent.innerHTML = html;
            }
        });
    }

    function storePosition() {
        fetch(`/positions`, {
            method: 'POST',
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
                loadPositions();
                document.getElementById('positionNameInput').value = '';
                document.getElementById('positionNameError').textContent = '';
            } else if (response.status === 422) {
                return response.json().then(data => {
                    document.getElementById('positionNameError').textContent = data.message;
                });
            }
        });
    }

    function updatePosition(id) {
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
                loadPositions();
                document.getElementById('positionNameInput').value = '';
                document.getElementById('positionNameError').textContent = '';
            } else if (response.status === 422) {
                return response.json().then(data => {
                    document.getElementById('positionNameError').textContent = data.message;
                });
            }
        });
    }

    function deletePosition(position) {
        let confirmed = confirm(`Удалить должность
         ${position.name}?`);

        if (confirmed) {
            fetch(`/positions/${position.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then(response => {
                if (response.status === 200) {
                    loadPositions();

                    const table = window.LaravelDataTables['users-table'];
                    table.ajax.reload();
                }
            });
        }
    }

    loadPositions();
</script>
