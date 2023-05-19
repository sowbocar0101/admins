{{-- ====A+P+P+K+E+Y==== --}}

{{-- <input type="file" value="{{ asset('image/test.mp4') }}"> --}}
@extends('layouts.app_admin')

{{-- @extends('layouts.app_admin') --}}

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.1/themes/fontawesome-stars.min.css">

<style>
.nav{
  margin-top: 20px !important;
}
.font-dashboard-small{
  font-size: 14px;
}
</style>
@endpush
<!-- CSS -->

<!-- CONTENT -->
@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-5 mb-4 mb-xl-0">
          <h4 class="font-weight-bold">@lang('default.new.dashboard.title')</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card grid-margin">
          <div class="card-body row">
            <div class="col-md-5" style="text-align: right;">
              <img src="{{ asset('icon/card-driver.svg') }}" style="width: 100%;">
            </div>
            <div class="col-md-7">
              <h4>@lang('default.new.card.driver')</h4>
              <h1 class="new-text-aqua-color">{{$driver}}<span style="font-size: 1rem" class="new-text">@lang('default.text.card-count-dashboard')</span></h1>
            </div>
          </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card grid-margin">
          <div class="card-body row">
            <div class="col-md-5" style="text-align: right;">
              <img src="{{ asset('icon/card-user.svg') }}" style="width: 100%;">
            </div>
            <div class="col-md-7">
              <h4>@lang('default.new.card.user')</h4>
              <h1 class="new-text-aqua-color">{{$user}}<span style="font-size: 1rem" class="new-text">@lang('default.text.card-count-dashboard')</span></h1>
            </div>
          </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card grid-margin">
          <div class="card-body row">
            <div class="col-md-5" style="text-align: right;">
              <img src="{{ asset('icon/card-type-taxi.svg') }}" style="width: 100%;">
            </div>
            <div class="col-md-7">
              <h4>@lang('default.new.card.type-taxi')</h4>
              <h1 class="new-text-aqua-color">{{$typeTaxi}}<span style="font-size: 1rem" class="new-text">@lang('default.new.card.type-taxi-text')</span></h1>
            </div>
          </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card grid-margin">
        <div class="card-body">
            {{--  <p class="card-title text-md-center text-xl-left">@lang('default.dashboard.info.lates_order')</p>  --}}
            <div class="col-md-12 row">
              <div class="col-md-6">
                <h4 class="font-weight-bold">@lang('default.dashboard.info.lates_order')</h4>
              </div>
              <div class="col-md-6" style="text-align: right;">
                <h4 class="font-weight-bold"><a href="{{ route('order.index') }}" style="color:#08588B">@lang('default.dashboard.info.view_all_order') <img src="{{ asset('icon/arrow-right.svg') }}"></a></h4>
              </div>
            </div>
          </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                  <thead style="background: #08588B; color:white;">
                    <th style="width: 10px;">@lang('default.table.no')</th>
                    <th>@lang('default.new.table.user-location')</th>
                    <th>@lang('default.new.table.destination')</th>
                    <th style="width: 250px">@lang('default.new.status')</th>
                  </thead>
                  <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($order as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{substr($item->start_address, 0, 100)}}...</td>
                        <td>{{substr($item->end_address, 0, 100)}}...</td>
                        <td>
                            {{-- @if($item->status == IS_PENDING)
                                <div class="badge badge-primary" style="background: #707070;">@lang('default.new.order.pending')</div>
                            @elseif($item->status == IS_DRIVER_ACCEPT)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.driver_accept')</div>
                            @elseif($item->status == IS_DEPARTURE)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.departure')</div>
                            @elseif($item->status == IS_DEPARTURE_CONFIRMATION)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.departure-confirmation')</div>
                            @elseif($item->status == IS_ARRIVAL)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.arrival')</div>
                            @elseif($item->status == IS_COMPLETE)
                                <div class="badge badge-success" style="background: #08588B;">@lang('default.new.order.complete')</div>
                            @elseif($item->status == IS_CANCEL)
                                <div class="badge badge-danger" style="background: #707070;">@lang('default.new.order.cancel')</div>
                            @endif --}}

                            @if($item->status == IS_PENDING)
                                <div class="badge badge-primary" style="background: #707070;">@lang('default.new.order.pending')</div>
                            @elseif($item->status == IS_DRIVER_ACCEPT)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.driver_accept')</div>
                            @elseif($item->status == IS_DEPARTURE_TO_CUSTOMER)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.departure_to_customer')</div>
                            @elseif($item->status == IS_ARRIVAL_AT_CUSTOMER)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.arrival_to_customer')</div>
                            @elseif($item->status == IS_CUSTOMER_CONFIRMATION)
                                <div class="badge badge-warning" style="background: #08588B;">@lang('default.new.order.customer_confirmation')</div>
                            @elseif($item->status == IS_DEPARTURE_TO_DESTINATION)
                                <div class="badge badge-success" style="background: #08588B;">@lang('default.new.order.departure_to_destination')</div>
                            @elseif($item->status == IS_ARRIVAL_AT_DESTINATION)
                                <div class="badge badge-danger" style="background: #08588B;">@lang('default.new.order.arrival_to_destination')</div>
                            @elseif($item->status == IS_COMPLETE)
                                <div class="badge badge-danger" style="background: #707070;">@lang('default.new.order.complete')</div>
                            @elseif($item->status == IS_CANCEL)
                                <div class="badge badge-danger" style="background: #707070;">@lang('default.new.order.cancel')</div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <hr> --}}
                {{--  <a href="{{route('order.index')}}" class="btn btn-secondary btn-sm float-right">@lang('default.dashboard.info.view_all_order')</a>  --}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
<!-- CONTENT -->

<!-- JS -->
@push('js')
@endpush
<!-- JS -->
