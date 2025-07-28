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
        document.getElementById('positionMethodInput').value = 'POST';
        document.getElementById('positionNameError').textContent = '';
        document.getElementById('confirmChangePositionButton').textContent = '{{ trans('main.add_button') }}';
        document.getElementById('positionsModalHeader').textContent = '{{ trans('main.users.add_position_header') }}';
    }
</script>
