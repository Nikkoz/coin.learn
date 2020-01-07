@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                @yield('title')
            </h1>
        </div>
        <div class="col-sm-6">
            @section('breadcrumbs', Breadcrumbs::render())
            @yield('breadcrumbs')
        </div>
    </div>
@endsection

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

        $('.select2').select2();

        $('.select2-without-search').select2({
            minimumResultsForSearch: Infinity
        });

        $('.summernote').summernote({
            height: 200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['Insert', ['picture', 'link', 'table', 'hr']],

            ],
            popover: {
                image: [],
                link: [],
                air: []
            },
            callbacks: {
                onImageUpload: function (files) {
                    let editor = $(this);
                    let url = editor.data('image-url');
                    let data = new FormData();

                    data.append('file', files[0]);

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            editor.summernote('insertImage', response);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error(textStatus);
                        }
                    });
                }
            }
        });

        bsCustomFileInput.init();
    </script>

    @stack('added-js')
@stop