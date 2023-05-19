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
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="name" class="form-control" v-model="data.name" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.username') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="username" class="form-control" v-model="data.username" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.password') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="password" name="password" class="form-control" v-model="data.password" style="border-radius: 5px;" required>
                                @if ($errors->has('password'))
                                    <br>
                                    <span style="color:red;"><i>{{ $errors->first('password') }}</i></span>
                                @endif
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
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.name') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="name" class="form-control" v-model="data.name" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.username') <small class="text-danger">*</small></label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="text" name="username" class="form-control" v-model="data.username" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-xl-2 col-form-label">@lang('default.table.password')</label>
                            <div class="col-sm-9 col-xl-10">
                                <input type="password" name="password" class="form-control" v-model="data.password" style="border-radius: 5px;">
                                <small><i>@lang('default.alert.password')</i></small>
                                @if ($errors->has('password'))
                                    <br>
                                    <span style="color:red;"><i>{{ $errors->first('password') }}</i></span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix">
                            <div>
                                <div class="lds-dual-ring" v-if="loading"></div>
                                {{--  <button type="submit" class="btn btn-primary text-white action-header" :disabled='loading'><i class="ti-save"></i>
                                    @lang('default.action.save')</button>  --}}
                                <button type="submit" class="btn new-button new-bg-aqua action-header" style="width: 100%;" :disabled='loading'><h4 class="fon-weight-bold">@lang('default.new.save')</h4></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
