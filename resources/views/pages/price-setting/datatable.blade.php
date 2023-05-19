{{-- ====A+P+P+K+E+Y==== --}}

<div class="card" id="content-table">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="row float-right" style="margin-right: 0px;">
                    <div class="column">
                        <a href="#!" class="btn new-btn-add-aqua action-header btn-create-pricing d-none" onclick="showCreate()" id="create"><i class="ti-plus"></i>
                            @lang('default.new.price-setting.add')
                        </a>
                        <a href="#!" class="btn new-btn-add-aqua action-header btn-create-pricing" onclick="showSetting()" id="create">
                            @lang('default.order_setting')
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-borderless">
                        <thead style="background: #08588B; color:white;">
                            <tr>
                                <th style="width: 10px;">@lang('default.table.no')</th>
                                <th>@lang('default.table.name')</th>
                                <th style="width: 70px;">@lang('default.table.price')</th>
                                <th style="width: 70px;">@lang('default.table.distance')</th>
                                <th style="width: 70px;">@lang('default.table.min-price')</th>
                                <th style="width: 50px;">@lang('default.table.seat')</th>
                                <th style="width: 50px;">@lang('default.table.min-m')</th>
                                <th style="width: 100px;">@lang('default.table.action')</th>
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


{{-- <div class="card" id="content-table">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="row float-right" style="margin-right: 0px;">
                    <div class="column">
                        <a href="#!" class="btn new-btn-add-aqua action-header" onclick="showSetting()" id="setting">
                            <img src="{{ asset('icon/edit-solid.png') }}" style="width: 18px;">
                            @lang('default.new.setting.index')
                        </a>
                        <a href="#!" class="btn new-btn-add-aqua action-header btn-create-pricing" onclick="showCreate()" id="create"><i class="ti-plus"></i>
                            @lang('default.new.price-setting.add')
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-borderless">
                        <thead style="background: #08588B; color:white;">
                            <tr>
                                <th style="width: 10px;">@lang('default.table.no')</th>
                                <th>@lang('default.table.name')</th>
                                <th style="width: 50px;">@lang('default.table.min-km')</th>
                                <th style="width: 70px;">@lang('default.table.min-price')</th>
                                <th style="width: 50px;">@lang('default.table.km')</th>
                                <th style="width: 70px;">@lang('default.table.price')</th>
                                <th style="width: 50px;">@lang('default.table.seat')</th>
                                <th style="width: 100px;">@lang('default.table.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}
