<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body>
        @include('partials.headpan')
        
        <div style="height: 120px"></div>

        @include('partials.messages')

        <div class="wrapper">
            <div class="row">
                <!-- @include('partials.leftpan') -->
                
                <!-- middle -->
                <div class="col-6">
                    <div class="shadow-box container pt-2">
                        
                        <h1>User Profile</h1>
                        <hr class="dark-hr">

                        <div class="wrapper" align="center">
                            <img src="{{ '/storage/' . $profile->image }}" width="300px" class="rounded-circle" style="border: 2px solid #636b6f">

                            <div style="width: 200px">
                                <hr>
                            </div>

                            <h2 class="mt-3">
                                {{ strtoupper($profile->nickname) }}
                            </h2>
                            <strong>{{ $user->email }}</strong>

                            <div style="width: 200px">
                                <hr>
                            </div>

                            <strong>ABOUT {{ (isset($volunteer)) ? 'ME' : 'US' }}?</strong>
                            <p>
                                {{ $profile->description }}
                            </p>

                            <div style="width: 200px">
                                <hr>
                            </div>

                            <strong>RATING AS {{ (isset($volunteer)) ? 'VOLUNTEER' : 'SPONSOR' }}</strong>
                            <p>
                                {{ (isset($volunteer)) ? $user->volunteer->rating : $user->sponsor->rating }}
                            </p>
                        </div>
                    </div>

                    <!-- sponsor rating -->
                    @if (isset($sponsor))
                        @include('partials.sponsor_rating')
                    @endif
                    <!-- end sponsor rating -->

                <!-- end middle -->
            </div>  
            
            <div class="col-3">
                <!-- as volunteer -->
                @if (isset($volunteer))
                    @include('partials.volunteer_activities')
                @endif
                <!-- end as volunteer -->

                <!-- as sponsor -->
                @if (isset($sponsor))
                    @include('partials.sponsor_activities')
                @endif
                <!-- end as sponsor -->
            </div>
        </div>
    </body>

    <script type="text/javascript" defer>
        function toggle_details(id) {
            $('#act'+id).slideToggle(250);
        }

        function toggle_expand(_class) {
            $('.row-hidden.' + _class).slideToggle(250);
        }

        jQuery(document).ready(function($) {
            $('.ellipsis').hover(function() {
                $(this).removeClass('ellipsis');
            }, function() {
                $(this).addClass('ellipsis');
            });
        });
    </script>
</html>
