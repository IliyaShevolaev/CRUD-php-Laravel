@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

@stop

@section('content')
    <x-adminlte-datatable id="table1" :heads="['ID', 'Name', 'Actions']">
        @foreach ($users as $row)
            <tr>
                <td>{!! $row['id'] !!}</td>
                <td>{!! $row['name'] !!}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
