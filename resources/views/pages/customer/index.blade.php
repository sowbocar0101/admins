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
        <h2 class="title-header">@lang('default.new.user.index')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('customer.index')}}" style="color:#444444;">@lang('default.new.user.index')</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-create">
        <h2 class="title-header">@lang('default.new.user.title-create')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('customer.index')}}" style="color: #444444;">@lang('default.new.user.index')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.user.sub-title-create')</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-6 col-sm-12" id="breadcrumb-edit">
        <h2 class="title-header">@lang('default.new.user.title-edit')</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb transparent">
                <li class="breadcrumb-item"><a href="{{route('customer.index')}}" style="color: #444444;">@lang('default.new.user.index')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('default.new.user.sub-title-edit')</li>
            </ol>
        </nav>
    </div>
    {{--  <div class="col-md-6 col-sm-12">
        <div class="div">
            <div class="float-right">
                <a href="#!" class="btn btn-primary text-white action-header" id="create"><i class="ti-plus"></i>
                    @lang('default.action.create')
                </a>
                <a href="#!" class="btn btn-danger text-white action-header display-n" id="back"><i class="ti-arrow-left"></i>
                    @lang('default.action.back')
                </a>
            </div>
        </div>
    </div>  --}}
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

@include('pages.customer.form')

@include('pages.customer.datatable')

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
            handleFileUpload(type){
                if(type == 'create'){
                    this.data.image = this.$refs.create.files[0];
                } else {
                    this.data.image = this.$refs.edit.files[0];
                }
            },
            saveData(e){
                e.preventDefault();
                let self = this,
                    formData = new FormData()

                formData.append('name', self.data.name)
                formData.append('email', self.data.email)
                formData.append('phone', self.data.phone)
                formData.append('password', self.data.password)
                formData.append('image', self.data.image)
                formData.append('_token', "{{csrf_token()}}")


                self.postDataMultipart("{{route('customer.store')}}", formData)
            },
            updateData(e){
                e.preventDefault();
                let self = this,
                    formData = new FormData()

                formData.append('name', self.data.name)
                formData.append('email', self.data.email)
                formData.append('phone', self.data.phone)
                formData.append('password', self.data.password)
                formData.append('image', self.data.image)
                formData.append('status', self.data.status)
                formData.append('_token', "{{csrf_token()}}")
                formData.append('_method', "PUT")


                self.postDataMultipart("{{route('customer.index')}}/"+self.data.id+"", formData)
            },
            fetchData(url){
                let self = this

                axios.get(url+'/edit')
                .then(function (response) {
                    self.data = response.data
                    self.initDropify(self.data.image ? "{{ asset('') }}"+self.data.image : ""+"");
                    self.removeTableAdmin();
                    self.removeCreateForm();
                    self.showEditForm();
                })
                .catch(function (error) {
                    self.showDangerNotif(error.message)
                });
            },
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
                ajax: "{{route('customer.index')}}?type=datatable",
                processing: true,
                serverSide : true,
                responsive: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: 'Bfrtip',
                buttons: [
                    // {
                    //     text: "@lang('default.action.export.csv')",
                    //     action: function ( e, dt, node, config ) {
                    //         location.href = "{{route('customer.export')}}?type=csv"
                    //     }
                    // },
                    // {   extend: 'csv', text: "@lang('default.action.export.csv')",  bom: true,
                    //     title: 'User' + new Date().toISOString().slice(0, 10),
                    //     exportOptions: {
                    //         columns: [ 0, 3, 4, 5 ],
                    //         format: {
                    //             body: function ( data, row, column, node ) {
                    //                 // Strip $ from salary column to make it numeric
                    //                 return column === 3 ?
                    //                 "'" + data + "'" : data;
                    //             }
                    //         },
                    //     }
                    // },
                    // {
                    //     text: "@lang('default.action.export.excel')",
                    //     action: function ( e, dt, node, config ) {
                    //         location.href = "{{route('customer.export')}}?type=excel"
                    //     }
                    // },
                    {
                        text: "@lang('default.action.export.print')",
                        action: function ( e, dt, node, config ) {
                            location.href = "{{route('customer.export')}}?type=print"
                        }
                    }
                    // 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
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
                order: [[ 1 ]],
                columns: [
                    {
                        data: "id", orderable: false, searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: "updated_at", name: "updated_at", visible: false, searchable: false},
                    { data: "image", name: "image", orderable: false },
                    { data: "name", name: "name" },
                    { data: "email", name: "email" },
                    { data: "phone", name: "phone" },
                    { data: "status", name: "status" },
                    { data: "action", name: "action", orderable: false }
                ]
            });
        },
    })
</script>
@endpush
<!-- JS -->
