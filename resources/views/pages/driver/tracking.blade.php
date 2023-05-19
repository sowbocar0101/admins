{{-- ====A+P+P+K+E+Y==== --}}

@extends('layouts.app_admin')

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h2 class="title-header">@lang('default.new.driver.tracking.title')</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb transparent">
                    <li class="breadcrumb-item"><a href="{{route('driver.track')}}" style="color:#444444;">@lang('default.new.driver.index')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('default.new.driver.tracking.sub-title')</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card" id="content-table">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&callback=initMap&language={{ Lang::locale() != 'jp' ? Lang::locale() : 'ja' }}"></script>
<script>

    var map;
    var markers = [];
    var bali = {lat: parseFloat({!! $default_map[0] !!}), lng: parseFloat({!! $default_map[1] !!}) };
    var activeInfoWindow
    var icons = {
        marker: {
            icon: '{{ URL::asset('icon/taxi.png') }}',
        },
    };

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: bali,
        });

        addMarker(map)
    }

    function addMarker(map) {
        $.get("{{ route('driver.track.list') }}", function(data, status){
            $.each(data, function( index, value ) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(value.position[0], value.position[1]),
                    icon: {
                            url:icons['marker'].icon,
                            scaledSize: new google.maps.Size(30, 50), // scaled size
                            origin: new google.maps.Point(0,0), // origin
                            anchor: new google.maps.Point(0, 0) // anchor
                    },
                    map: map,
                });
                markers.push(marker);
                var contentString =
                    '<div class="col-md-12 row" style="width:400px;">'+
                        '<div class="col-md-4">'+
                            '<img src="'+"{{ asset('') }}"+"/"+value.image+'" style="width:75px; height:75px; padding: 5px;">'+
                        '</div>'+
                        '<div class="col-md-8">'+
                            '<span class="font-weight-bold"> {{ Lang::get('default.new.username') }} : '+value.name+'</span><br>'+
                            '<span class="font-weight-bold"> {{ Lang::get('default.new.driver.car-model') }} : '+value.car_model+'</span><br>'+
                            '<span class="font-weight-bold"> {{ Lang::get('default.new.driver.back-number') }} : '+value.plate_number+'</span>'+
                        '</div>'+
                    '</div>';

                addInfoWindow(map,marker,contentString)
            });
        });
    }

    function addInfoWindow(map,marker,contentString) {
        google.maps.event.addListener(marker,'click', (function(marker,contentString){
            return function() {
                if(activeInfoWindow){
                    activeInfoWindow.close();
                }
                activeInfoWindow = new google.maps.InfoWindow({
                    content: contentString
                });
                activeInfoWindow.setContent(contentString);
                activeInfoWindow.open(map,marker);
            };
        })(marker,contentString,activeInfoWindow));
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function showMarkers() {
        setMapOnAll(map)
    }

    function deleteMarkers() {
        setMapOnAll(null);
    }
</script>
@endpush
