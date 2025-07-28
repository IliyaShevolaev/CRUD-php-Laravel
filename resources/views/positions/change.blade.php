@component('components.modal-window')
    @slot('modalId')
        addPositionModal
    @endslot
    @slot('modalTitle')
        <p id="positionsModalHeader">{{ trans('main.users.add_position_header') }}</p>
    @endslot

    <div>
        <div class="form-group">
            <input type="text" class="form-control" id="positionNameInput"
                placeholder="{{ trans('main.title_placeholder') }}">
            <p class="text-danger" id="positionNameError"></p>
        </div>
    </div>

    @slot('footer')
        <button onclick="" id="confirmChangePositionButton" type="button" class="btn btn-primary w-100">
            {{ trans('main.add_button') }}
        </button>
    @endslot
@endcomponent

<script>

</script>
