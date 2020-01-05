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
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if (session(DashboardFlashTypeDictionary::ERROR) )
            toastr["error"]("{{ session(DashboardFlashTypeDictionary::ERROR) }}");
        @elseif(session(DashboardFlashTypeDictionary::WARNING))
            toastr["warning"]("{{ session(DashboardFlashTypeDictionary::WARNING) }}");
        @elseif (session(DashboardFlashTypeDictionary::INFO) )
            toastr["info"]("{{ session(DashboardFlashTypeDictionary::INFO) }}");
        @elseif (session(DashboardFlashTypeDictionary::SUCCESS) )
            toastr["success"]("{{ session(DashboardFlashTypeDictionary::SUCCESS) }}");
        @endif
    </script>
@stop