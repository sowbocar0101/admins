{{-- ====A+P+P+K+E+Y==== --}}
@extends('layouts.app_admin')

@push('css')
    <link rel="stylesheet" href="{{asset('izitoast/css/iziToast.min.css')}}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@500&family=Nanum+Gothic&display=swap');
    </style>
@endpush

@section('content')
    <div class="row index">
        <div class="col-md-6 col-sm-12" id="breadcrumb-index">
            <h2 class="title-header">@lang('default.sidenav.about-us')</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb transparent">
                    <li class="breadcrumb-item active" aria-current="page">@lang('default.sidenav.about-us')</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card index">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row float-right" style="margin-right: 0px;">
                        <div class="column">
                            <a href="#" onclick="edit()" class="btn new-btn-add-aqua action-header btn-edit-about-us">
                                <img src="{{ asset('icon/edit-solid.png') }}" style="width: 20px;">
                                @lang('default.new.about-us.title-edit')
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <span>{!! $item->text ?? '' !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row edit">
        <div class="col-md-6 col-sm-12" id="breadcrumb-edit">
            <h2 class="title-header">@lang('default.new.about-us.title-edit')</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb transparent">
                    <li class="breadcrumb-item"><a href="{{route('about-us.index')}}" style="color: #444444;">@lang('default.new.about-us.index')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('default.new.about-us.sub-title-edit')</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="div">
                <div class="float-right">
                    <a href="#" class="action-header" onclick="back()" id="back" style="color:#6A6A6A;"><i class="ti-arrow-left"></i>
                        @lang('default.action.back')
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card edit">
        <div class="card-body">
            <div class="col-12">
                <form action="{{ route('about-us.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <textarea class="tinymce" name="text">{{ $item->text ?? '' }}</textarea>
                    <br>
                    <button type="submit" style="width: 100%;" class="btn new-btn-add-aqua">@lang('default.action.save')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.edit').hide();

        function edit(){
            $('.index').hide();
            $('.edit').fadeIn();
        }

        function back(){
            $('.index').fadeIn();
            $('.edit').hide();
        }
    </script>

    <script src="{{asset('izitoast/js/iziToast.min.js')}}"></script>
    @if(session('alert'))
        <script>
            iziToast.success({
                title: "@lang('default.alert.success_text')",
                message: "{{ session('alert') }}",
                position: 'topRight',
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            iziToast.error({
                title: "@lang('default.alert.error_text')",
                message: "{{ session('error') }}",
                position: 'topRight',
            });
        </script>
    @endif

    <script src="https://cdn.tiny.cloud/1/ncoiy87n6q3l0ly2wgzlyt14srgsykm7lu3jrkpq4pzw75kl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        let lang
        if("{{ Lang::locale() }}" == "jp"){
            lang = "ja";
        }else{
            lang = "{{ Lang::locale() }}"
        }
        tinymce.init({
            selector:'.tinymce',
            images_upload_url: "{!! url('tiny-image-upload') !!}",
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            automatic_uploads: true,
            content_style:
                "@import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@500&family=Nanum+Gothic&display=swap'); body { font-family: 'Gothic A1', sans-serif; } h1,h2,h3,h4,h5,h6",
            font_formats:
                "Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats; Arial Black=arial black,avant garde; Courier New=courier new,courier; Gothic =Gothic A1;",
            height: 600,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount',
                'image',
            ],
            // file_browser_callback: filemanager.tinyMceCallback
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | image',
            /* without images_upload_url set, Upload tab won't show up*/
            // images_upload_url: "{{ url('public/tinymce/postAcceptor.php') }}",

            language: lang,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
        });
    </script>

@endpush
