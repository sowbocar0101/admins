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
        <h2 class="title-header">@lang('default.sidenav.admin')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item active" aria-current="page">@lang('default.sidenav.admin')</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-create">
        <h2 class="title-header">@lang('default.new.admin.title-create')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}" style="color: #444444;">@lang('default.new.admin.index')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.admin.sub-title-create')</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-edit">
        <h2 class="title-header">@lang('default.new.admin.title-edit')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}" style="color: #444444;">@lang('default.new.admin.index')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.admin.sub-title-edit')</li>
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

@include('pages.admin.form')

@include('pages.admin.datatable')

@endsection
<!-- CONTENT -->

<!-- JS -->
@push('js')
<script>

    $('#breadcrumb-create').hide();
    $('#breadcrumb-edit').hide();

    function showIndex(){
        $('#breadcrumb-index').fadeIn();
        $('#breadcrumb-create').hide();
        $('#breadcrumb-edit').hide();
    }

    function showCreate(){
        $('#breadcrumb-index').hide();
        $('#breadcrumb-create').fadeIn();
        $('#breadcrumb-edit').hide();
    }

    function showEdit(){
        $('#breadcrumb-index').hide();
        $('#breadcrumb-create').hide();
        $('#breadcrumb-edit').fadeIn();
    }

    var app = new Vue({
        el: '#app',
        mixins: [mixin],
        methods: {
            saveData(e){
                e.preventDefault();
                let self = this

                self.postData("{{route('admin.store')}}", {
                    name: self.data.name,
                    username: self.data.username,
                    password: self.data.password,
                    _token: "{{csrf_token()}}"
                })
            },
            updateData(e){
                e.preventDefault();
                let self = this,
                    url = "{{route('admin.index')}}/"+self.data.id+""

                self.postData(url, {
                    name: self.data.name,
                    username: self.data.username,
                    password: self.data.password,
                    _token: "{{csrf_token()}}",
                    _method: "PUT"
                })
            }
        },
        mounted() {
            // Datatable Config
            let dataTable = $("#datatable").DataTable({
                ajax: "{{route('admin.index')}}?type=datatable",
                processing: true,
                serverSide : true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    // {   extend: 'csv', text: "@lang('default.action.export.csv')",  bom: true,
                    //     title: 'Admin' + new Date().toISOString().slice(0, 10),
                    //     exportOptions: {
                    //         columns: [ 0, 2, 3 ]
                    //     }
                    // },
                    // {
                    //     text: "@lang('default.action.export.excel')",
                    //     action: function ( e, dt, node, config ) {
                    //         location.href = "{{route('admin.export')}}?type=excel"
                    //     }
                    // },
                    {
                        text: "@lang('default.action.export.print')",
                        action: function ( e, dt, node, config ) {
                            location.href = "{{route('admin.export')}}?type=print"
                        }
                    }
                ],
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
                order: [[ 1 ]],
                columns: [
                    {
                        data: "id", orderable: false, searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: "updated_at", name: "updated_at", visible: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "username", name: "username" },
                    { data: "action", name: "action", orderable: false }
                ]
            });
        },
    })
</script>


@endpush
<!-- JS -->
