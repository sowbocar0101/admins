{{-- ====A+P+P+K+E+Y==== --}}

{{-- CREATE --}}
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
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.image') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-2">
                                <input required type="file" name="image" class="dropify mb-3 img-lg" id="createDropify" data-max-file-size="1M" data-allowed-file-extensions="jpeg png jpg gif" ref="create" v-on:change="handleFileUpload('create')"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label"></label>
                            <div class="col-sm-9 col-xl-10">
                                <span style="padding-top:3px;"><i>@lang('default.alert.file.image') </i></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.username') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="name" class="form-control" v-model="data.name" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.email') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="email" name="email" class="form-control" v-model="data.email" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.password') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="password" name="password" class="form-control" v-model="data.password" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.phone') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="number" name="phone" class="form-control" v-model="data.phone" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.driver.back-number') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="plate_number" class="form-control" v-model="data.plate_number" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.driver.car-type') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <select name="vehicle_category_id" class="form-control" v-model="data.vehicle_category_id" style="border-radius: 5px;" required>
                                    <option value="" selected>@lang('default.text.select')</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.driver.car-model') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="car_model" class="form-control" v-model="data.car_model" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        {{--  <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.image') </label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="file" name="image" class="dropify mb-3 img-lg" id="createDropify" data-max-file-size="1M" data-allowed-file-extensions="jpeg png jpg gif" ref="create" v-on:change="handleFileUpload('create')"/>
                                <span style="padding-top:3px;"><i>@lang('default.alert.file.image') </i></span>
                            </div>
                        </div>  --}}
                        <div class="clearfix">
                            <div>
                                <div class="lds-dual-ring" v-if="loading"></div>
                                {{--  <button type="submit" class="btn btn-primary text-white action-header" :disabled="loading"><i class="ti-save"></i>
                                    @lang('default.action.save')</button>  --}}
                                <button type="submit" class="btn new-button new-bg-aqua action-header" style="width: 100%;" :disabled="loading"><h4 class="fon-weight-bold">@lang('default.new.save')</h4></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT --}}
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
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.image')</label>
                            <div class="col-sm-9 col-xl-2">
                                    <input type="file" name="image" class="dropify mb-3 img-lg" id="editDropify"
                                    data-max-file-size="1M" data-allowed-file-extensions="jpeg png jpg gif"
                                    ref="edit"
                                    v-on:change="handleFileUpload('edit')"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label"></label>
                            <div class="col-sm-9 col-xl-10">
                                <span style="padding-top:3px;"><i>@lang('default.alert.file.image') </i></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="name" class="form-control" v-model="data.name" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.email') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="email" name="email" class="form-control" v-model="data.email" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.password') </label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="password" name="password" class="form-control" v-model="data.password" style="border-radius: 5px;">
                                <small><i>@lang('default.alert.password')</i></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.phone') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="number" name="phone" class="form-control" v-model="data.phone" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.driver.back-number') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="plate_number" class="form-control" v-model="data.plate_number" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.driver.car-type') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <select name="vehicle_category_id" class="form-control" v-model="data.vehicle_category_id" style="border-radius: 5px;" required>
                                    <option value="" selected>@lang('default.text.select')</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.driver.car-model') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="car_model" class="form-control" v-model="data.car_model" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.new.status') </label>
                            <div class="col-sm-9 col-xl-10">
                                <select name="status" v-model="data.status" class="form-control" style="border-radius: 5px;">
                                    <option value="1">@lang('default.new.active')</option>
                                    <option value="0">@lang('default.new.inactive')</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div>
                                <div class="lds-dual-ring" v-if="loading"></div>
                                {{--  <button type="submit" class="btn btn-primary text-white action-header" :disabled="loading"><i class="ti-save"></i>
                                    @lang('default.action.save')</button>  --}}
                                <button type="submit" class="btn new-button new-bg-aqua action-header" style="width: 100%;" :disabled="loading"><h4 class="fon-weight-bold">@lang('default.new.save')</h4></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
