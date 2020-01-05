@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        @yield('title')
    </h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('build/css/admin_custom.css') }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop