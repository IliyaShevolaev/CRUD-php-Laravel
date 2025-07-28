@extends('adminlte::page')

@section('title', config('app.name', 'CRUD Laravel'))

@section('content')
    @yield('content')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    @vite(['resources/sass/app.scss', 'resources/css/table-custom-style.css'])

    <style>
    </style>

@stop

@section('js')
    @vite(['resources/js/app.js'])
    @stack('scripts')
@stop
