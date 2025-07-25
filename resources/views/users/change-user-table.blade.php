@extends('layouts.lte-layout')
@section('content')
    <div class="mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3>{{ isset($user) ? trans('main.users.edit_header') : trans('main.users.add_header') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                    method="POST">
                    @csrf
                    @isset($user)
                        @method('PATCH')
                    @endisset
                    <div class="form-group">
                        <label for="name">{{ str(trans('main.users.name'))->ucfirst() }}</label>
                        <input value="{{ isset($user) ? $user->name : old('name') }}" name="name" type="text"
                            class="form-control" id="name"
                            placeholder="{{ trans('main.users.enter_name_placeholder') }}">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">{{ str(trans('main.users.email'))->ucfirst() }}</label>
                        <input value="{{ isset($user) ? $user->email : old('email') }}" name="email" type="email"
                            class="form-control" id="email"
                            placeholder="{{ trans('main.users.enter_email_placeholder') }}">

                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ str(trans('main.users.password'))->ucfirst() }}</label>
                        <input value="{{ old('password') }}" name="password" type="password" class="form-control"
                            id="password" placeholder="{{ trans('main.users.enter_password_placeholder') }}">

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">{{ str(trans('main.users.password_confirmation'))->ucfirst() }}</label>
                        <input value="{{ old('password_confirmation') }}" name="password_confirmation" type="password"
                            class="form-control" id="password_confirmation"
                            placeholder="{{ trans('main.users.enter_password_confirmation_placeholder') }}">

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="department">{{ str(trans('main.users.department'))->ucfirst() }}</label>
                        <select class="form-control select2bs4" id="department_id" name="department_id">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ isset($user)  && $user->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                            <option {{!isset($user) || $user->department_id === null ? 'selected' : ''}} value="{{null}}">
                                {{trans('main.users.without_department')}}
                            </option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="position">{{ str(trans('main.users.position'))->ucfirst() }}</label>
                        <select class="form-control select2bs4" id="position" name="position_id">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}"
                                    {{ isset($user)  && $user->position == $position->id ? 'selected' : '' }}>
                                    {{ $position->name }}
                                </option>
                            @endforeach
                            <option {{!isset($user) || $user->position === null ? 'selected' : ''}} value="{{null}}">
                                {{trans('main.users.without_position')}}
                            </option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="gender">{{ str(trans('main.users.gender'))->ucfirst() }}</label>
                        <select class="form-control select2bs4" id="gender" name="gender">
                            @foreach ($genders as $gender)
                                <option value="{{ $gender}}"
                                    {{ isset($user)  && $user->gender == $gender ? 'selected' : '' }}>
                                    {{ trans('main.users.genders.' . $gender) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="status">{{ str(trans('main.users.status'))->ucfirst() }}</label>
                        <select class="form-control select2bs4" id="status" name="status">
                            @foreach ($statuses as $status)
                                <option value="{{ $status}}"
                                    {{ isset($user)  && $user->status == $status ? 'selected' : '' }}>
                                    {{ trans('main.users.statuses.' . $status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-1">
                        <button type="submit"
                            class="btn btn-success w-50">{{ isset($user) ? trans('main.users.edit_user_button') : trans('main.users.create_user_button') }}</button>
                        <a href="{{ route('users.index') }}" type="submit"
                            class="btn btn-danger w-50">{{ trans('main.users.go_back_button') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
