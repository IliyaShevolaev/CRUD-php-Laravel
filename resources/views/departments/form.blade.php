<form id="changeDepartmentForm" action="{{ $route }}" method="POST">
    @csrf
    @if (isset($element))
        @method('PATCH')
    @endif
    <input name="name" type="text" class="form-control" id="departmentNameInput"
        placeholder="{{ trans('main.title_placeholder') }}" value="{{ isset($element) ? $element->name : '' }}">
    <p class="text-danger" id="departmentNameError"></p>
    
    <button class="btn btn-primary w-100" type="submit">Отправить</button>
</form>
