@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
@stop

@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>Список пользователей</h3>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="['ID', 'Почта', 'Имя', 'Роль', '']">
                @foreach ($users as $row)
                    @if (isset($editUserId) && $editUserId == $row['id'])
                        <form method="POST" action="{{ route('admin.users.update', $row['id']) }}">
                            @method('PATCH')
                            @csrf
                            <tr>
                                <td>{!! $row['id'] !!}</td>
                                <td><input name="email" type="email" class="form-control" value="{{ $row['email'] }}"></td>
                                <td><input name="name" type="text" class="form-control" value="{{ $row['name'] }}">
                                </td>
                                <td>
                                    <select name="role" class="form-control select2bs4">
                                        @foreach ($roles as $role)
                                            <option {{ $role === $row['role'] ? 'selected' : '' }}
                                                value="{{ $role }}">
                                                {{ $role }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-xs btn-default text-success mx-1 shadow"
                                        title="Save">
                                        <i class="fa fa-lg fa-fw fa-check"></i>
                                    </button>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-xs btn-default text-danger mx-1 shadow" title="Cancel">
                                        <i class="fa fa-lg fa-fw fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        </form>
                    @else
                        <tr>
                            <td>{!! $row['id'] !!}</td>
                            <td>{!! $row['email'] !!}</td>
                            <td>{!! $row['name'] !!}</td>
                            <td>{!! $row['role'] !!}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $row['id']) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $row['id']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                        title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.users.show', $row['id']) }}"
                                    class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @if (isset($inCreateMode))
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <tr>
                            <td>{{ $users->count() + 1 }}</td>
                            <td><input name="email" type="email" class="form-control"></td>
                            <td><input name="name" type="text" class="form-control"></td>
                            <td>
                                <select name="role" class="form-control select2bs4">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"> {{ $role }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-xs btn-default text-success mx-1 shadow"
                                    title="Save">
                                    <i class="fa fa-lg fa-fw fa-check"></i>
                                </button>
                                <a href="{{ route('admin.users.index') }}"
                                    class="btn btn-xs btn-default text-danger mx-1 shadow" title="Cancel">
                                    <i class="fa fa-lg fa-fw fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    </form>
                @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="{{ route('admin.users.create') }}"
                                class="btn btn-xs btn-default text-teal mx-1 shadow" title="Add">
                                <i class="fa fa-lg fa-fw fa-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endif
            </x-adminlte-datatable>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
