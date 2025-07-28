@extends('layouts.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>{{ trans('main.users.positions') }}</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <button onclick="createPosition()" type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#addPositionModal">
                    <i class="fas fa-plus mr-1"></i>
                </button>

                <div class="mt-3">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
    @include('positions.change')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

<script>
    function createPosition() {
        document.getElementById('positionNameInput').value = '';
        document.getElementById('positionNameError').textContent = '';
        document.getElementById('confirmChangePositionButton').textContent = '{{ trans('main.add_button') }}';
        document.getElementById('positionsModalHeader').textContent =
            '{{ trans('main.users.add_position_header') }}';
        document.getElementById('confirmChangePositionButton').onclick = function() {
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
        };
    }
</script>
