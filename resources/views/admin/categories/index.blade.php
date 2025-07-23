@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

@stop

@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3>Список категорий</h3>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="['ID', 'Название', '']">
                @foreach ($categories as $row)
                    @if (isset($editCategoryId) && $editCategoryId == $row['id'])
                        <form method="POST" action="{{ route('admin.categories.update', $row['id']) }}">
                            @method('PATCH')
                            @csrf
                            <tr>
                                <td>{!! $row['id'] !!}</td>
                                <td>
                                    <input name="name" type="text" class="form-control" value="{{ $row['name'] }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-xs btn-default text-success mx-1 shadow"
                                        title="Save">
                                        <i class="fa fa-lg fa-fw fa-check"></i>
                                    </button>
                                    <a href="{{ route('admin.categories.index') }}"
                                        class="btn btn-xs btn-default text-danger mx-1 shadow" title="Cancel">
                                        <i class="fa fa-lg fa-fw fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        </form>
                    @else
                        <tr>
                            <td>{!! $row['id'] !!}</td>
                            <td>{!! $row['name'] !!}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $row['id']) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $row['id']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                        title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @if (isset($inCreateMode))
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <tr>
                            <td>{{ $categories->count() + 1 }}</td>
                            <td>
                                <input name="name" type="text" class="form-control">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <button type="submit" class="btn btn-xs btn-default text-success mx-1 shadow"
                                    title="Save">
                                    <i class="fa fa-lg fa-fw fa-check"></i>
                                </button>
                                <a href="{{ route('admin.categories.index') }}"
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
                        <td>
                            <a href="{{ route('admin.categories.create') }}"
                                class="btn btn-xs btn-default text-teal mx-1 shadow" title="Add">
                                <i class="fa fa-lg fa-fw fa-plus-circle"></i>
                            </a>
                        </td>
                    </tr>
                @endif
            </x-adminlte-datatable>
        </div>
    @stop

    @section('css')
        {{-- Add here extra stylesheets --}}
        {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    @stop

    @section('js')
    @stop
