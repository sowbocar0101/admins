{{-- ====A+P+P+K+E+Y==== --}}

{{-- TABLE --}}
<div class="card" id="content-table">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="row float-right" style="margin-right: 0px;">
                    <div class="column">
                        <a href="#!" class="btn new-btn-add-aqua action-header btn-create-admin"
                            onclick="showCreate()" id="create"><i class="ti-plus"></i>
                            @lang('default.new.admin.add')
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    {{-- LATER USE LARAVEL DATATABLE --}}
                    <table id="datatable" class="table table-borderless">
                        <thead style="background: #08588B; color:white;">
                            <tr>
                                <th style="width: 10px;">@lang('default.table.no')</th>
                                <th></th>
                                <th>@lang('default.table.full_name')</th>
                                <th style="width: 100px;">@lang('default.table.username')</th>
                                <th style="width: 50px;">@lang('default.table.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
