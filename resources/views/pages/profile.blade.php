{{-- ====A+P+P+K+E+Y==== --}}

@extends('layouts.app_admin')

<!-- CSS -->
@push('css')
<style>
    .tab-content{
        background-color: #fff;
        padding: 30px !important;
    }
</style>
@endpush
<!-- CSS -->

<!-- CONTENT -->
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session()->get('success') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div class="card grid-margin mb-4 col-md-12">
        <div class="card-body">

            <form method="POST" action="{{route('profile.store')}}">
            @csrf
                {{-- <div class="form-group row">
                    <label for="account-number" class="col-sm-2 col-form-label font-weight-bold">@lang('default.new.image')</label>
                    <div class="col-sm-10">
                        <img src="{{asset('/images/user-male.jpg')}}" style="width: 150px; border-radius:15px;">
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label for="account-number" class="col-sm-2 col-form-label font-weight-bold">@lang('default.table.full_name')</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" style="border-radius: 5px" required value="{{$data->name}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="account-number" class="col-sm-2 col-form-label font-weight-bold">@lang('default.table.username')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" style="border-radius: 5px" required value="{{$data->username}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="account-number" class="col-sm-2 col-form-label font-weight-bold">@lang('default.new.password')</label>
                    <div class="col-sm-10">
                        <input id="password" type="password" style="border-radius: 5px;" class="form-control" name="password">
                        <small><i>@lang('default.alert.password')</i></small>
                        @if ($errors->has('password'))
                            <br>
                            <span style="color:red;"><i>{{ $errors->first('password') }}</i></span>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn new-button new-bg-aqua" style="width: 100%;"><h4 class="fon-weight-bold">@lang('default.new.save')</h4></button>
            </form>
        </div>
    </div>

    {{--  <div class="col-md-4">
        <div class="card grid-margin">
            <div class="card-body text-center">
                <img src="{{asset('/images/user-male.jpg')}}" class="rounded-circle" style="width: 50%;" alt="profile">
                <h4 style="margin-top:15px;">{{$data->name}}</h4>
                <h5>@lang('default.sidenav.admin')</h5>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <ul class="nav nav-tabs" style="margin-top:0px !important; " id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="configuration-tab" data-toggle="tab" href="#configuration" role="tab"
                    aria-controls="configuration" aria-selected="true">@lang('default.text.config')</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="configuration" role="tabpanel"
                aria-labelledby="configuration-tab">
                    <form method="POST" action="{{route('profile.store')}}">
                        @csrf
                        <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('default.table.full_name') <small class="text-danger">*</small></label>
                                <div class="col-sm-8"><input type="text" name="name" class="form-control" required value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">@lang('default.table.username') <small class="text-danger">*</small></label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" class="form-control" required value="{{$data->username}}">
                                </div>
                            </div>
                            <div class="form-group row align-self-center">
                                <label class="col-sm-4 col-form-label">@lang('default.table.password')</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control">
                                    <small><i>@lang('default.alert.password')</i></small>
                                </div>
                            </div>
                            <div class="clearfix">
                                    <button type="submit" class="btn btn-primary text-white action-header" ><i class="ti-save"></i>
                                        @lang('default.action.save')</button>
                            </div>
                </form>
            </div>
        </div>
    </div>  --}}
</div>
@endsection
<!-- CONTENT -->
