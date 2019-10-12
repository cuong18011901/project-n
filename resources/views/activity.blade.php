<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body>
        @include('partials.headpan')
        
        <div style="height: 120px"></div>
        <div class="wrapper">
            <div class="row">
                @include('partials.leftpan')
                
                <!-- middle -->
                <div class="col-6">
                    <div class="shadow-box container pt-2">
                        <h1>{{ strtoupper($activity->title) }}</h1>
                        <hr class="dark-hr">

                        <div class="pt-3 pb-3" align="center">
                            <img src="{{ '/storage/' . $activity->image }}" width="400px" alt="">
                            <div style="width: 200px">
                                <hr class="dark-hr mt-3">
                            </div>
                        </div>
                        
                        <div class="wrapper">
                            <div class="row">
                                <div class="col-3">Description</div>
                                <div class="col-1">:</div>
                                <div class="col-8">{{ $activity->description }}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Date</div>
                                <div class="col-1">:</div>
                                <div class="col-8">{{ $activity->start }}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Status</div>
                                <div class="col-1">:</div>
                                <div class="col-8 {{ ($activity->status === 'finished') ? 'act-finished' : 'act-ongoing' }}">
                                    {{ $activity->status }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">Budget</div>
                                <div class="col-1">:</div>
                                <div class="col-8">{{ $activity->budget . ' VND' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Concern</div>
                                <div class="col-1">:</div>
                                <div class="col-8">{{ $activity->concern }}</div>
                            </div>
                            <div class="row">
                                <div class="col-3">Sponsor</div>
                                <div class="col-1">:</div>
                                <div class="col-8"><a href="{{ route('profile.index', $activity->sponsor->id) }}">{{ strtoupper($activity->sponsor->user->profile->nickname) }}</a></div>
                            </div>
                            
                            <div align="center" class="pt-4">
                                <hr class="dark-hr mt-3 mb-3">
                                @if (isset($sponsor))
                                    @if ($holding)
                                        <button onclick="toggle_modal()" class="w-100 button-g-reverse button-l">SETTING</button>
                                    @else
                                        <a href="#">
                                            <div class="button-g-reverse button-l">NOT YOURS, CAN'T DO SHIT</div>
                                        </a>
                                    @endif
                                @else
                                    @if (isset($volunteer) && $volunteer->activities->contains($activity->id))
                                        <a href="#">
                                            <div class="button-g-reverse button-l">QUIT (TOTAL RATING WILL BE REDUCED)</div>
                                        </a>
                                    @else
                                        <a href="#">
                                            <div class="button-b-reverse button-l">SIGN UP FOR THIS ACTIVITY!</div>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                    
                    <div class="shadow-box">
                        <div class="wrapper">
                            @if (Auth::user())
                                <form action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group shadow-textarea">
                                        <label for="comment">COMMENT</label>
                                        <textarea class="form-control z-depth-1" name="comment" id="comment" rows="3" placeholder="Write your thoughts about this activity..."></textarea>
                                        
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="text-left">
                                        <input type="hidden" id="activity_id" name="activity_id" value="{{ $activity->id }}">
                                        <input type="hidden" id="profile_id" name="profile_id" value="{{ Auth::user()->profile->id }}">
                                        <input type="submit" class="button-r-reverse button-s">
                                    </div>
                                </form>
                            @else
                            <div align="center">
                                <a href="{{ route('login') }}">
                                    <button class="button-r-reverse button-s">Login to leave a comment</button>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3" style="font-size: 18px">
                        PEOPLE'S THOUGHTS ON THIS ACTIVITY
                    </div>

                    <!-- comments -->
                    <div class="shadow-box">
                        <div class="wrapper" style="margin-top: 10px">
                            @if ($comments->count() !== 0)
                                @foreach ($comments as $comment)
                                    <div class="row pb-1 pt-1 div-hover-dark">
                                        <div class="col-2" align="center">
                                            <img src="{{ '/storage/' . $comment->profile->image }}" width="60px" class="rounded-circle pb-1" alt="">
                                            <a href="{{ route('profile.index', $comment->profile->id) }}">
                                                <div class="ellipsis">{{ strtoupper($comment->profile->nickname) }}</div>
                                            </a>
                                        </div>   
                                        <div class="col-10">{{ $comment->content }}</div>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <h5>No comments have been added for this activity so far</h5>
                            @endif

                            {{ $comments->links() }}
                        </div>
                    </div>
                    <!-- end comments -->

                </div>
                <!-- end middle -->

                <!-- Participants -->
                <div class="col-3">
                    <div class="shadow-box">
                        <div class="content pt-2">
                            <h1>
                                Participants
                            </h1>
                            <hr class="dark-hr">
                            <?php $i = 1 ?>
                            @foreach ($volunteers as $vol)
                                <div class="container {{ ($i >= 5) ? 'row-hidden' : '' }}">
                                    <div class="participant-list row">
                                        <div class="col-4">
                                            <a href="{{ route('profile.index', $vol->user->profile->id) }}">
                                                <img src="{{ '/storage/' . $vol->user->profile->image }}" width="80px" class="rounded-circle" alt="">
                                            </a>
                                        </div>
                                        <div class="col-6 my-auto ellipsis">
                                            <a href="{{ route('profile.index', $vol->user->profile->id) }}"><strong>{{ $vol->user->profile->nickname }}</strong>
                                            </a>
                                        </div>
                                        <button class="col-2 my-auto button-r-reverse" onclick="toggle_details('{{$vol->id}}')">&darr;
                                        </button>
                                    </div>

                                    <!-- details -->
                                    <div class="container" style="display: none" id="{{ 'vol' . $vol->id }}">
                                        <hr style="margin: auto; margin-top: 0px;">
                                        @if ($activity->status === 'finished')
                                        <div class="row text-left div-hover-dark">
                                            <div class="col-4">Rating</div>
                                            <div class="col-8">
                                                {{ ': ' . $ratings->where('volunteer_id', $vol->id)->first()->rating }}
                                            </div>
                                        </div>
                                        <div class="row text-left div-hover-dark">
                                            <div class="col-4">Comment</div>
                                            <div class="col-8">
                                                {{ ': ' . ($ratings->where('volunteer_id', $vol->id)->first()->comment ?? 'None') }}
                                            </div>
                                        </div>
                                        <div class="row text-left div-hover-dark">
                                            <div class="col-4">Ovl.Rtg</div>
                                            <div class="col-8">
                                                {{ ': ' . $vol->rating }}
                                            </div>
                                        </div>
                                        @else
                                        <h4 class="pt-2">Not yet rated</h4 class="pt-2">
                                        @endif
                                    </div>
                                </div>
                                <!-- end details -->
                                <hr style="margin: 0px">
                                <?php ++$i ?>
                            @endforeach

                        </div>
                        <button onclick="toggle_extend()" class="pt-2 pb-2 button-r-reverse round-bottom upper w-100">all</button>
                    </div>
                </div>
                <!-- end participants -->

            </div>  
        </div>


        <!-- modal -->
        @if(isset($holding) && $holding)
        <div class="f-modal-veil" id="rate-veil" align="center">
            <div class="f-modal-content" id="rate-modal">
                <h1>ACTIVITY SETTING</h1>
                <hr class="dark-hr">

                <div class="row mt-3">
                    <div class="col-3" align="center">
                        <img src="{{ '/storage/' . $activity->image }}" class="rounded-circle" width="200px" alt="">
                        <div class="pt-2"><strong>{{ $activity->title }}</strong></div>
                        <button class="w-100 mt-2 button-b-reverse upper p-2" onclick="toggle_rating()">finish</button>
                        <button class="w-100 mt-2 button-r-reverse upper p-2" onclick="toggle_modal()">close</button>
                    </div>
                    <div class="col-9 text-left">
                        <strong>Participants</strong>
                        <hr class="m-0">
                        <div class="row" id="vol-pan">
                            @foreach ($volunteers as $vol)
                                <div class="col-4">
                                    <a href="{{ route('profile.index', $vol->user->profile->id) }}">
                                        <div class="div-hover-dark row">
                                            <div class="col-4 m-2">
                                                <img src="{{ '/storage/' . $vol->user->profile->image }}" width="80px" class="rounded-circle" alt="">
                                            </div>
                                            <div class="col-7 my-auto">{{ $vol->user->profile->nickname }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- rating -->
                        <div id="vol-eval" style="display: none">
                            @if ($activity->status === 'on going')
                                <form action="{{ route('rating.store') }}" method="POST">
                                    @csrf
                                    @foreach ($activity->tags as $t)
                                        <input type="hidden" name="tags[]" value="{{ $t->id }}">
                                    @endforeach
                                    <input type="hidden" name="activity_id" value="{{$activity->id}}">
                                    @foreach ($volunteers as $vol)
                                        <input type="hidden" name="rate[{{$vol->id}}][volunteer_id]" value="{{$vol->id}}">
                                        <input type="hidden" name="rate[{{$vol->id}}][sponsor_id]" value="{{$sponsor->id}}">
                                        <div class="row m-3">
                                            <div class="col-2"><img src="{{ '/storage/' . $vol->user->profile->image }}" width="80px" class="rounded-circle" alt=""></div>
                                            <div class="col-3 my-auto">
                                                <select name="rate[{{$vol->id}}][rating]" class="form-control">
                                                    @for ($i = 1; $i <= 5; ++$i)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-6 my-auto">
                                                <input type="text" class="form-control" name="rate[{{$vol->id}}][comment]" placeholder="{{ $vol->user->profile->nickname }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <input type="submit" name="" value="">
                                </form>
                            @else
                            <div class="pt-3">
                                <h2>
                                    Activity already finished and volunteers all rated
                                </h2>
                            </div>
                            @endif
                        </div>
                        <!-- end rating -->

                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function toggle_rating() {
                $('#vol-pan').slideToggle(250);
                $('#vol-eval').slideToggle(250);
            }

            function toggle_modal() {
                $('#rate-veil').toggle();
            }
        </script>

        @endif
        <!-- end modal -->

        <script type="text/javascript">
            function toggle_details(id) {
                $('#vol' + id).slideToggle(250);
            }

            function toggle_extend() {
                $('.row-hidden').slideToggle(250);
            }
        </script>

    </body>
</html>
