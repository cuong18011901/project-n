@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="mulpart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="type" name="type">
                                    <option value="1">Sponsor</option>
                                    <option value="2">Volunteer</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}">
                            </div>
                        </div>
                        @error('nickname')
                                <strong>{{ $message }}</strong>
                        @enderror

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>
                        </div>
                        @error('message')
                                <strong>{{ $message }}</strong>
                        @enderror
    
                        <div class="form-group row align-items-baseline">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
            
                            <div class="col-md-6">
                                <input type="file" class = 'form-control-file' id = 'image' name = 'image'>
            
                                @error('image')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row align-items-baseline">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
            
                            <div class="col-md-3">
                                <input type="text" class='form-control' id='lat' name = 'lat'>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class='form-control' id='lng' name = 'lng'>
                            </div>
                        </div>

                        
                
                            <div id="map" class="col-md-8 offset-2">
                                
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('head')
    <script type="text/javascript" defer="">
            var map;
            var markers = [];

            function initMap() {
                var options = {
                    zoom:8,
                    center:{lat:16.05, lng:108.21}
                }

                map = new google.maps.Map(document.getElementById('map'), options);

                map.addListener('click', function(event) {
                    deleteMarkers();
                    addMarker(event.latLng);
                    document.getElementById("lat").value = event.latLng.lat();
                    document.getElementById("lng").value = event.latLng.lng();
                });

            // Adds a marker at the center of the map.
            }

            // Adds a marker to the map and push to the array.
            function addMarker(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
                markers.push(marker);
            console.log(121);
            }

            function drawMarker(_lat, _lng) {
                console.log(_lat + " " + _lng);
                var marker = new google.maps.Marker({
                    position: {lat:_lat, lng:_lng},
                    map:map,
                    title:'none'
                });
                markers.push(marker);
            }
      
            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                  markers[i].setMap(map);
                }
            }


            function clearMarkers() {
                setMapOnAll(null);
            }

    
            function showMarkers() {
                setMapOnAll(map);
            }

            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }
      

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr0_-9qHME0pI790HK2p7s_bfeKS95Zhs&callback=initMap"
async defer>
        </script>
        @endpush
</div>
@endsection
