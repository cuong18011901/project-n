<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css'>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">

        <style type="text/css">
            
            #map {
                height: 300px;
            }

        </style>

    </head>
    <body>
        @include('partials.headpan')
        
        <div style="height: 120px"></div>
        @include('partials.messages')
        <div class="wrapper">
            <div class="row">
                <!-- @include('partials.leftpan') -->
                <div class="col-3">
                </div>
                <!-- middle -->
                <div class="col-6">
                    <div class="shadow-box container">
                        <h1 class="pt-2">Concerned activities</h1>
                        <hr class="dark-hr mb-2">
                        <form action="{{ route('volunteer.destroy') }}" id="remove-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="remove_id" name="remove_id">
                        </form>

                        <form action="{{ route('volunteer.store') }}" id="partake-form" method="POST">
                            @csrf
                            <input type="hidden" id="partake_id" name="partake_id">
                        </form>
                    </div>
                </div>
                <div class="container" >
                        <div class="row">
                        <div class="col-md-6">
                            <div class="row">
        
                            </div>
                            <div class="panel panel-default">
                            <div class="panel-body">
                        @foreach (\App\Activity::orderBy('created_at','DESC')->get() as $act)
                        <div class="row div-hover-dark pt-2 pb-2">
                            <div class="col-3 my-auto" align="center">
                                <img src="{{ '/storage/' . $act->image }}" width="100px" alt="">
                            </div>
                            <div class="col-3 text-left">
                                <div>Title</div>
                                <div>Description</div>
                                <div>Start</div>
                                <div>Status</div>
                                <div>Budget</div>
                                <div>Sponsor</div>
                                <button onclick="open_modal('{{ $act->lat }}', '{{ $act->lng }}')" class="button-g-reverse pt-1 pb-1">Location</button>

                            </div>
                            <div class="col-6 text-left">
                                <div>{{ ': ' . $act->title }}</div>
                                <div class="ellipsis">{{ ': ' . $act->description }}</div>
                                <div>{{ ': ' . $act->start }}</div>
                                <div class="{{ ($act->status === 'finished') ? 'act-finished' : 'act-ongoing' }}">{{ ': ' . $act->status }}</div>
                                <div>{{ ': ' . $act->budget . ' VND'}}</div>
                                <div>{{ ': ' }}<a href="{{ route('profile.index', $act->sponsor->id) }}">{{ $act->sponsor->fullname }}</a></div>
                                <div class="text-right mt-2">
                                    <a href="{{ route('activity.index', $act->id) }}">
                                        <button class="button-r-reverse upper button-s">details</button>
                                    </a>
                                    @if($act->status === 'on going')
                                        @if (isset($sponsor))
                                            @if ($sponsor->activities->contains($act->id))
                                                <button class="button-g-reverse upper button-s">setting</button>
                                            @endif
                                        @else
                                            @if (isset($volunteer) && $volunteer->activities->contains($act->id))
                                                <a href="#" onclick="event.preventDefault(); submitRemove('{{$act->id}}')">
                                                    <button class="button-g-reverse button-s upper">quit</button>
                                                </a>
                                            @else
                                                <a href="#" onclick="event.preventDefault(); submitPartake('{{$act->id}}')">
                                                    <button class="button-b-reverse button-s upper">partake</button>
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        
                        <hr>
                        <br>
                    @endforeach
                    </div>
                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-body text-center">
                                    <div class="col-md-3">
                                        <img src="http://icons.iconarchive.com/icons/creativeflip/starwars-longshadow-flat/96/C3PO-icon.png" class="img-responsive" alt="Responsive image">
                                        <button type="button" class="btn btn-default">Follow <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="http://icons.iconarchive.com/icons/creativeflip/starwars-longshadow-flat/96/Leia-icon.png" class="img-responsive" alt="Responsive image">
                                        <button type="button" class="btn btn-default">Follow <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="http://icons.iconarchive.com/icons/creativeflip/starwars-longshadow-flat/96/Yoda-icon.png" class="img-responsive" alt="Responsive image">
                                        <button type="button" class="btn btn-default">Follow <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="http://icons.iconarchive.com/icons/creativeflip/starwars-longshadow-flat/96/Luke-Skywalker-icon.png" class="img-responsive" alt="Responsive image">
                                        <button type="button" class="btn btn-default">Follow <i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                        <div class="panel-body">
                                        <img src="http://screenrant.com/wp-content/uploads/John-Boyega-Finn-Wallpaper-Star-Wars-7.jpg" class="img-responsive" alt="Responsive image">
                                        <hr>
                                        <h1>Tiêu đề</h1>
                                        <p>Remember the elderly gentleman we met at the beginning of the film? Lor San Tekka handed off the map to Luke Skywalker to Poe Dameron. He’s sympathetic to the cause, obviously, and it turns out he remained loyal to the Jedi throughout the
                                            Empire’s rule. He was part of the Church of the Force. Followers were “loosely affiliated worshippers of the Jedi ideals.”</p>
                                        </div>
                                    </div>
                 </div>
                 </div>



                </div>
                <!-- end middle -->

                <div class="f-modal-veil" id="veil" align="center">
                    <div class="f-modal-content" id="modal">
                        <h1>ACTIVITY SETTING</h1>
                        <hr class="dark-hr">
                        <div id="map" class="col-8">
                            
                        </div>
                        <button class="button-r-reverse upper p-3 mt-3 cbut">close</button>
                    </div>
                </div>

                @include('partials.leftpan')
            </div>  
        </div>

        <script type="text/javascript" >

            jQuery(document).ready(function($) {
                $('.cbut').click(function() {
                    $('#veil').toggle();
                    deleteMarkers();
                })
            });
            
            function submitRemove(id) {
                document.getElementById('remove_id').value = id;
                document.getElementById('remove-form').submit();
            }

            function submitPartake(id) {
                document.getElementById('partake_id').value = id;
                document.getElementById('partake-form').submit();
            }

            function open_modal(_lat, _lng) {
                $('#veil').toggle();
                drawMarker(parseFloat(_lat), parseFloat(_lng));
            }

            var map;
            var markers = [];

            function initMap() {
                var options = {
                    zoom:8,
                    center:{lat:16.05, lng:108.21}
                }

                map = new google.maps.Map(document.getElementById('map'), options);

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



      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }

        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr0_-9qHME0pI790HK2p7s_bfeKS95Zhs&callback=initMap"
    async defer></script>

    </body>
</html>
