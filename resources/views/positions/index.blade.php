@extends('layouts.lte-layout')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>{{ trans('main.users.positions') }}</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <button onclick="createPosition()" type="button" class="btn btn-success">
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

    <script>
        function createPosition() {
        $('#positionsModalHeader').text('{{ trans('main.users.add_position_header') }}');

            $.ajax({
                method: 'GET',
                url: "{{ route('positions.create') }}",
                success: function(data) {
                    $('#addPositionModal').find('#form-placeholder').empty().append(data)
                    new bootstrap.Modal($('#addPositionModal')).show();
                }
            });
        }
    </script>
@endpush
