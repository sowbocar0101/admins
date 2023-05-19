{{-- ====A+P+P+K+E+Y==== --}}

@extends('layouts.app_admin')

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12" id="breadcrumb-index">
        <h2 class="title-header">@lang('default.new.price-setting.index')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('price-setting.index')}}" style="color:#444444;">@lang('default.new.price-setting.index')</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-create">
        <h2 class="title-header">@lang('default.new.price-setting.title-create')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('price-setting.index')}}" style="color: #444444;">@lang('default.new.price')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.price-setting.sub-title-create')</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-edit">
        <h2 class="title-header">@lang('default.new.price-setting.title-edit')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('price-setting.index')}}" style="color: #444444;">@lang('default.new.price')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.price-setting.sub-title-edit')</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-setting">
        <h2 class="title-header">@lang('default.order_setting_title')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('price-setting.index')}}" style="color: #444444;">@lang('default.order_setting_breadcrumb')</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="div">
            <div class="float-right">
                <a href="#!" class="action-header display-n" onclick="showIndex()" id="back" style="color:#6A6A6A;"><i class="ti-arrow-left"></i>
                    @lang('default.action.back')
                </a>
            </div>
        </div>
    </div>
</div>

@include('pages.price-setting.form')
@include('pages.price-setting.datatable')
@include('pages.price-setting.setting')

@endsection
<!-- CONTENT -->

<!-- JS -->
@push('js')
<script>
    $('#breadcrumb-create').hide();
    $('#breadcrumb-edit').hide();
    $('#breadcrumb-setting').hide();
    $('#content-setting').hide()

    function showIndex(){
        $('#breadcrumb-index').fadeIn();
        $('#content-table').fadeIn();
        $('#breadcrumb-create').hide();
        $('#breadcrumb-edit').hide();
        $('#breadcrumb-setting').hide();
        $('#content-setting').hide()
    }

    function showCreate(){
        $('#breadcrumb-index').hide();
        $('#breadcrumb-create').fadeIn();
        $('#breadcrumb-edit').hide();
        $('#breadcrumb-setting').hide();
    }

    function showEdit(){
        $('#breadcrumb-index').hide();
        $('#breadcrumb-create').hide();
        $('#breadcrumb-edit').fadeIn();
        $('#breadcrumb-setting').hide();
    }

    function showSetting(){
        $('#breadcrumb-index').hide();
        $('#breadcrumb-create').hide();
        $('#breadcrumb-edit').hide();
        $('#content-table').hide();
        $('#back').css('display', 'inline-block');

        $('#content-setting').fadeIn();
        $('#content-create').hide();
        $('#breadcrumb-setting').fadeIn();

        $.ajax({
            url: "{{ route('setting') }}",
            type: "GET",
            dataType: "JSON",
            success : function(data) {
                $('#min_discount').val(data.min_discount)
                $('#discount').val(data.discount)
                $('#night_service').val(data.night_service)
            },
        });

        $('#setting-form').on("submit", function(event){
            event.preventDefault();
            $.ajax({
                url : "{{ route('setting.update') }}",
                type : "POST",
                data: new FormData($("#setting-form")[0]),
                contentType: false,
                processData: false,
                success : function(data) {
                    showIndex()
                    iziToast.success({
                        title: "@lang('default.alert.success_text')",
                        message: "@lang('default.alert.success.update')",
                        position: 'topRight',
                    });
                },
            });
        });
    }

    var app = new Vue({
        el: '#app',
        mixins: [mixin],
        methods: {
            saveData(e){
                e.preventDefault();
                let self = this

                self.postData("{{route('price-setting.store')}}", {
                    name: self.data.name,
                    price: self.data.price,
                    distance: self.data.distance,
                    min: self.data.min,
                    min_price: self.data.min_price,
                    seat: self.data.seat,
                    extra_km: self.data.extra_km,
                    _token: "{{csrf_token()}}"
                })
            },
            updateData(e){
                e.preventDefault();
                let self = this,
                    url = "{{route('price-setting.index')}}/"+self.data.id+""

                self.postData(url, {
                    name: self.data.name,
                    price: self.data.price,
                    distance: self.data.distance,
                    min: self.data.min,
                    min_price: self.data.min_price,
                    seat: self.data.seat,
                    extra_km: self.data.extra_km,
                    _token: "{{csrf_token()}}",
                    _method: "PUT"
                })
            }
        },
        mounted() {
            // var lang = "{{Lang::locale()}}";

            // var datatableLang = function(){
            //     if(lang=='id'){
            //         return '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json';
            //     }else if(lang=='en'){
            //         return '//cdn.datatables.net/plug-ins/1.10.19/i18n/English.json';
            //     }else if(lang=='jp'){
            //         return '//cdn.datatables.net/plug-ins/1.10.19/i18n/Japanese.json';
            //     }
            // }

            // Datatable Config
            let dataTable = $("#datatable").DataTable({
                ajax: "{{route('price-setting.index')}}?type=datatable",
                processing: true,
                serverSide : true,
                responsive: true,
                // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                // dom: 'Bfrtip',
                // buttons: [
                //     'pageLength', 'copyHtml5', 'csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'
                // ],
                // oLanguage: {
                //     sUrl: datatableLang()
                // },
                language: {
                    decimal: "@lang('datatable.decimal')",
                    emptyTable: "@lang('datatable.emptyTable')",
                    info: "@lang('datatable.info')",
                    infoEmpty: "@lang('datatable.infoEmpty')",
                    infoFiltered: "@lang('datatable.infoFiltered')",
                    infoPostFix: "@lang('datatable.infoPostFix')",
                    thousands: "@lang('datatable.thousands')",
                    lengthMenu: "@lang('datatable.lengthMenu')",
                    loadingRecords: "@lang('datatable.loadingRecords')",
                    processing: "@lang('datatable.processing')",
                    search: "@lang('datatable.search')",
                    zeroRecords: "@lang('datatable.zeroRecords')",
                    paginate: {
                        first: "@lang('datatable.first')",
                        last: "@lang('datatable.last')",
                        next: "@lang('datatable.next')",
                        previous: "@lang('datatable.previous')"
                    },
                    aria: {
                        sortAscending:  "@lang('datatable.sortAscending')",
                        sortDescending: "@lang('datatable.sortDescending')"
                    }
                },
                order: [[ 0 ]],
                columns: [
                    {
                        data: "id", orderable: false, searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: "name", name: "name" },
                    { data: "price", name: "price" },
                    { data: "distance", name: "distance" },
                    { data: "min-price", name: "min-price" },
                    { data: "seat", name: "seat" },
                    { data: "min", name: "min" },
                    { data: "action", name: "action", orderable: false }
                ]
            });
        },
    })
</script>
@endpush
<!-- JS -->
