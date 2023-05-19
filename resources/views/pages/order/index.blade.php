{{-- ====A+P+P+K+E+Y==== --}}

@extends('layouts.app_admin')

<!-- CSS -->
@push('css')
@endpush
<!-- CSS -->

<!-- CONTENT -->
@section('content')

<div class="row">
    <div class="col-md-6 col-sm-12" id="breadcrumb-index">
        <h2 class="title-header title-index" id="breadcrumb">@lang('default.sidenav.data_order')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="color:#444444;">@lang('default.sidenav.data_order')</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-detail">
        <h2 class="title-header">@lang('default.new.order.title-detail')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('order.index')}}" style="color: #444444;">@lang('default.sidenav.data_order')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.order.title-detail')</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="button-back">
        <div class="div">
            <div class="float-right">
                <a href="#!" class="action-header" onclick="buttonBack()" style="color:#6A6A6A;"><i class="ti-arrow-left"></i>
                    @lang('default.action.back')
                </a>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="card" id="content-table">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive" id="div-table">
                    {{-- LATER USE LARAVEL DATATABLE --}}
                    <table id="datatable" class="table table-borderless">
                        <thead style="background: #08588B; color:white;">
                            <tr>
                                <th>@lang('default.table.no')</th>
                                {{-- <th>@lang('default.table.driver_name')</th> --}}
                                <th>@lang('default.table.customer_name')</th>
                                <th style="width: 10px;">@lang('default.new.table.user-location')</th>
                                <th>@lang('default.new.table.destination')</th>
                                <th>@lang('default.new.order.distance')</th>
                                <th>@lang('default.new.order.total-fee')</th>
                                <th>@lang('default.new.table.date-time')</th>
                                <th>@lang('default.text.detail')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                @include('pages.order.detail')
            </div>
        </div>
    </div>
</div>


@endsection
<!-- CONTENT -->

<!-- JS -->
@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=adsense&amp;sensor=false&language={{ Lang::locale() != 'jp' ? Lang::locale() : 'ja' }}"></script>

<script>
    var currency = {!! json_encode($currency) !!}

    $('.order-detail').hide();
    $('#breadcrumb-detail').hide();
    $('#button-back').hide();

    function showDetail(){
        $('#breadcrumb-index').hide();
        $('#breadcrumb-detail').fadeIn();
    }

    function detailOrder(id){
        $('#div-table').hide();
        $('#breadcrumb-index').hide();

        $('#breadcrumb-detail').fadeIn();
        $('#button-back').fadeIn();
        $('.order-detail').fadeIn();

        let url = "{{ url('') }}"+"/admin/"+"{{ Lang::locale() }}"+"/order"+"/"+id;
        $.get(url, function(data, status){
            $('#date_time').val(dateFormat(data.order_time)).prop('readonly', true);
            $('#username').val(data.customer.name).prop('readonly', true);
            $('#user_location').val(data.start_address).prop('readonly', true);
            $('#destination').val(data.end_address).prop('readonly', true);
            $('#distance').val(data.distance.toString().substring(0, 3)+"km").prop('readonly', true);
            $('#total_fee').val(currency+numberFormat(data.total)).prop('readonly', true);
            if(data.id_driver == 0){
                $('#driver_name').val("-").prop('readonly', true);
            }else{
                $('#driver_name').val(data.driver.name).prop('readonly', true);
            }

            usLatLng = data.start_coordinate
            desLatLng = data.end_coordinate
            userLatLng = usLatLng.split(",");
            desinationLatLng = desLatLng.split(",");
            initialize(userLatLng[0],userLatLng[1],desinationLatLng[0],desinationLatLng[1])
            google.maps.event.addDomListener(window, 'load', initialize);
        });

    }

    function buttonBack(){
        $('#breadcrumb-detail').hide();
        $('#button-back').hide();
        $('.order-detail').hide();
        clearValidation()

        $('#div-table').fadeIn();
        $('#breadcrumb-index').fadeIn();
        $('#breadcrumb-detail').hide();
    }

    function clearValidation(){
        $('#date_time').val('');
        $('#username').val('');
        $('#driver_name').val('');
        $('#user_location').val('');
        $('#destination').val('');
        $('#distance').val('');
        $('#total_fee').val('');
    }

    function dateFormat(data) {
        var lang = "{{ Lang::locale() }}";
        var date = new Date(data);
        if(lang == "jp"){
            return date.getFullYear().toString() + "年" + (date.getMonth() + 1).toString().padStart(2, '0') + "月" + date.getDate().toString().padStart(2, '0') + "日 " + date.getHours() + ":" + date.getMinutes();
        }else{
            return date.getFullYear().toString() + "-" + (date.getMonth() + 1).toString().padStart(2, '0') + "-" + date.getDate().toString().padStart(2, '0') + " " + date.getHours() + ":" + date.getMinutes();
        }
    }

    function initialize(usLat,usLng,desLat,desLang) {
        var userLatLng = new google.maps.LatLng(usLat,usLng);
        var destinationLatLng = new google.maps.LatLng(desLat,desLang);

        var mapOptionsUser = {
            zoom: 17,
            center: userLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: 0
        }

        var mapOptionsDestination = {
            zoom: 17,
            center: destinationLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: 0
        }

        var mapUser = new google.maps.Map(document.getElementById('map-user'), mapOptionsUser);
        var mapDestination = new google.maps.Map(document.getElementById('map-destination'), mapOptionsDestination);

        const iconUser = {
            url: '{{ URL::asset('icon/market-user.svg') }}', // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };

        var markerUser = new google.maps.Marker({
            position: userLatLng,
            map: mapUser,
            title: 'User Location',
            icon: iconUser
        });

        const iconDestination = {
            url: '{{ URL::asset('icon/marker-destination.svg') }}', // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };

        var markerDestination = new google.maps.Marker({
            position: destinationLatLng,
            map: mapDestination,
            title: 'Destination Location',
            icon: iconDestination
        });
    }

    var app = new Vue({
        el: '#app',
        mixins: [mixin],
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
                ajax: "{{route('order.index')}}?type=datatable",
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
                processing: true,
                serverSide : true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    //export all data--------------------------------------------------------
                    // {
                    //     text: "@lang('default.action.export.csv')",
                    //     action: function ( e, dt, node, config ) {
                    //         location.href = "{{route('order.export')}}?type=csv"
                    //     }

                    // },
                    //----------------------------------------------------------------------

                    //export 10 data
                    //----------------------------------------------------------------------
                    // {   extend: 'csv', text: "@lang('default.action.export.csv')",  bom: true,
                    //     title: 'Order' + new Date().toISOString().slice(0, 10),
                    //     exportOptions: {
                    //         columns: [ 0, 1, 2, 3, 4, 5, 6],
                    //     },
                    // },
                    //----------------------------------------------------------------------
                    // {
                    //     text: "@lang('default.action.export.excel')",
                    //     action: function ( e, dt, node, config ) {
                    //         location.href = "{{route('order.export')}}?type=excel"
                    //     }
                    // },
                    {
                        text: "@lang('default.action.export.print')",
                        action: function ( e, dt, node, config ) {
                            location.href = "{{route('order.export')}}?type=print"
                        }
                    }
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                // oLanguage: {
                //     sUrl: datatableLang()
                // },
                order: [[ 0 ]],
                columns: [
                    {
                        data: "id_order", orderable: false, searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {{-- { data: "driver", name: "driver" }, --}}
                    { data: "user", name: "user" },
                    { data: "from", name: "from" },
                    { data: "destination", name: "destination" },
                    { data: "distance", name: "distance", orderable: false  },
                    { data: "total", name: "total", orderable: false  },
                    { data: "date", name: "date", orderable: false  },
                    { data: "detail", name: "detail", orderable: false  },
                ]
            });
        },
    })
</script>
@endpush
<!-- JS -->
