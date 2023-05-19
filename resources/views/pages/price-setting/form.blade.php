{{-- ====A+P+P+K+E+Y==== --}}

<div class="row display-n" id="content-create">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <i>{!! trans('default.text.required-form') !!}</i>
                </div>
                <h2 class="title-form">@lang('default.text.add_data')</h2>
                <form method="post" @submit="saveData">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="text" name="name" class="form-control" v-model="data.name" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min_price" class="form-control" v-model="data.min_price" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-m') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min" class="form-control" v-model="data.min" required style="border-radius: 5px;" min="0">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="price" class="form-control" v-model="data.price" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.distance') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="distance" class="form-control" v-model="data.distance" required style="border-radius: 5px;" min="0">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.seat') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="seat" min="1" class="form-control" v-model="data.seat" required style="border-radius: 5px;">
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

<div class="row display-n" id="content-edit">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <i>{!! trans('default.text.required-form') !!}</i>
                </div>
                <h2 class="title-form">@lang('default.text.edit_data')</h2>
                <form method="post" @submit="updateData">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="text" name="name" class="form-control" v-model="data.name" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min_price" class="form-control" v-model="data.min_price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-m') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            {{-- <input type="number" name="min" class="form-control" v-model="data.min" required> --}}
                            <input type="number" name="min" class="form-control" v-model="data.min" required style="border-radius: 5px;" min="0">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="price" class="form-control" v-model="data.price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.distance') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="distance" class="form-control" v-model="data.distance" required style="border-radius: 5px;"  min="0">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.seat') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="seat" min="1" class="form-control" v-model="data.seat" required>
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


{{-- <div class="row display-n" id="content-create">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <i>{!! trans('default.text.required-form') !!}</i>
                </div>
                <h2 class="title-form">@lang('default.text.add_data')</h2>
                <form method="post" @submit="saveData">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="text" name="name" class="form-control" v-model="data.name" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-km') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min" class="form-control" v-model="data.min" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min_price" class="form-control" v-model="data.min_price" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.km') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="extra_km" class="form-control" v-model="data.extra_km" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="price" class="form-control" v-model="data.price" required style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.seat') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="seat" min="1" class="form-control" v-model="data.seat" required style="border-radius: 5px;">
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

<div class="row display-n" id="content-edit">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <i>{!! trans('default.text.required-form') !!}</i>
                </div>
                <h2 class="title-form">@lang('default.text.edit_data')</h2>
                <form method="post" @submit="updateData">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="text" name="name" class="form-control" v-model="data.name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-km') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min" class="form-control" v-model="data.min" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.min-price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="min_price" class="form-control" v-model="data.min_price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.km') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="extra_km" class="form-control" v-model="data.extra_km" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.price') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="price" class="form-control" v-model="data.price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.seat') <small class="text-danger">*</small></label>
                        <div class="col-sm-9 col-xl-10">
                            <input type="number" name="seat" min="1" class="form-control" v-model="data.seat" required>
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
</div> --}}
