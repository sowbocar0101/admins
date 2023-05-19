{{-- ====A+P+P+K+E+Y==== --}}

{{-- CREATE --}}
<div class="row display-n" id="content-setting">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <i>@lang('default.order_setting_title')</i>
                </div>
                {{-- <h2 class="title-form">@lang('default.new.setting.index')</h2> --}}
                <h2 class="title-form">@lang('default.text.edit_data')</h2>
                <form method="post" id="setting-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.min_price_discount') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" class="form-control" id="min_discount" name="min_discount" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.discount') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" class="form-control" id="discount" name="discount" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.night_service') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" class="form-control" id="night_service" name="night_service" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="clearfix">
                        <div>
                            <div class="lds-dual-ring" v-if="loading"></div>
                            <button type="submit" class="btn new-button new-bg-aqua action-header" style="width: 100%;" :disabled="loading"><h4 class="fon-weight-bold">@lang('default.new.save')</h4></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
