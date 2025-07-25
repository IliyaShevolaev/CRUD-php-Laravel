@component('components.modal-window')
    @slot('modalId')
        addTestModal
    @endslot
    @slot('modalTitle')
        Test Modal Window
    @endslot

    <h1>HEADER111</h1>
    <p>This is the content of your modal</p>

    @slot('footer')
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    @endslot
@endcomponent
