<form id="changePositionForm" action="{{ $route }}" method="POST">
    @csrf
    @if (isset($element))
        @method('PATCH')
    @endif
    <div data-field-name="name" class="mb-3">
        <label class="form-label">{{str(trans('main.users.name'))->ucfirst()}}</label>
        <input name="name" type="text" class="form-control" placeholder="{{ trans('main.title_placeholder') }}"
            value="{{ isset($element) ? $element->name : '' }}">
        <p class="text-danger"></p>
    </div>

    <hr>
    <button class="btn btn-primary w-100" type="submit"
        id="positionSubmitBtn">{{ isset($element) ? trans('main.edit_button') : trans('main.add_button') }}
    </button>
</form>
