@extends('adminlte::page')

@section('title', config('app.name', 'CRUD Laravel'))

@section('content')
    @yield('content')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    @vite(['resources/sass/app.scss'])
@stop

@section('js')
    @vite(['resources/js/app.js'])
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
