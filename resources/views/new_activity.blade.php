<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">

        <style>
            
            #map {
                height: 300px;
            }

        </style>

    </head>
    <body>
        @include('partials.headpan')
        
        <div style="height: 120px"></div>
        <div class="wrapper">
            <div class="row">
                @include('partials.leftpan')
                
                <!-- middle -->
                <div class="col-9">
                    <div class="shadow-box container">
                        <h1 class="pt-2">Hold a new Acitivity</h1>
                        <hr class="dark-hr">

                        <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mt-3">
                                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control z-depth-1 @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('title') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="start" class="col-md-2 col-form-label text-md-right">{{ __('Start') }}</label>

                                <div class="col-md-3">
                                    <input id="start" type="date" min="{{ date('Y-m-d') }}" class="form-control @error('start') is-invalid @enderror" value="{{ old('start') }}" name="start" autofocus>

                                    @error('start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="budget" class="col-md-2 col-form-label text-md-right">{{ __('Budget (VND)') }}</label>

                                <div class="col-md-2">
                                    <input id="budget" type="number" min='1' class="form-control @error('budget') is-invalid @enderror" name="budget" value="{{ old('budget') }}" autofocus>

                                    @error('budget')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3 align-items-baseline">
                                <label for="tags" class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</label>

                                @foreach (\App\Tag::all() as $t)
                                    <div class="col-2 text-left">
                                        <input name="tag_id_{{ $t->id }}" id="tag_id_{{ $t->id }}" value="{{ $t->id }}" type="checkbox" checked="">
                                        {{ strtoupper($t->name) }}

                                    </div>
                                @endforeach
                            </div>
        
                            <div class="form-group row align-items-baseline">
                                <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
                
                                <div class="col-md-6">
                                    <input type="file" class = 'form-control-file' id = 'image' name = 'image'>
                
                                    @error('image')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="form-group row align-items-baseline">
                                <label for="map" class="col-md-2 col-form-label text-md-right">{{ __('Location') }}</label>
                                <div class="col-md-4">
                                   <input type="text" id="lat" name="lat" class="form-control">
                                </div>
                                <div class="col-md-4">
                                   <input type="text" id="lng" name="lng" class="form-control">
                                </div>
                            </div>
                
                            <div id="map" class="col-md-8 offset-2">
                                
                            </div>

                            <div class="form-group row">
                                <div class="col-2"></div>
                                <div class="col-4">
                                    <input type="submit" class="button-b-reverse button-s" value="CONFIRM">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- end middle -->
            </div>  
        </div>

        <script type="text/javascript" >

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
    </body>
</html>
