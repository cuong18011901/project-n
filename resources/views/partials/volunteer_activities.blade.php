
<div class="shadow-box">
    <div class="content pt-2">
        <h1>Finished</h1>
        <hr class="dark-hr">
        <?php $i = 1 ?>
        @if($finished->count() !== 0)
            @foreach ($finished as $act)
                <div class="container {{ ($i >= 5) ? 'row-hidden finished' : '' }}">
                    <!-- overview -->
                    <div class="participant-list row">
                        <div class="col-4">
                            <a href="{{ route('activity.index', $act->id) }}">
                                <img src="{{ '/storage/' . $act->image }}" class="rounded" width="80px" alt="">
                            </a>
                        </div>

                        <div class="col-6 my-auto ellipsis">
                            <a href="{{ route('activity.index', $act->id) }}"><strong>{{ $act->title }}</strong>
                            </a>
                        </div>

                        <button class="button-r-reverse col-2 my-auto" onclick="toggle_details('{{ $act->id }}')">
                            &darr;
                        </button>

                    </div>
                    <!-- end overview -->

                    <!-- details -->
                    <div class="container" style="display: none" id="{{ 'act' . $act->id }}">
                        <div class="row text-left div-hover-dark">
                            <div class="col-4">Sponsor</div>
                            <div class="col-8">
                                <a href="{{ route('profile.index', $act->sponsor->user->profile->id) }}">
                                    {{ ': ' . $act->sponsor->user->profile->nickname }}
                                </a>
                            </div>
                        </div>
                        <div class="row text-left div-hover-dark">
                            <div class="col-4">Description</div>
                            <div class="col-8 ellipsis">{{ ': ' . $act->description }}</div>
                        </div>
                        <div class="row text-left div-hover-dark">
                            <div class="col-4">Concerns</div>
                            <div class="col-8">{{ ': ' . $act->concern }}</div>
                        </div>

                        <hr style="width: 200px; margin: auto; margin-top: 0px">
                        <div class="row text-left div-hover-dark">
                            <div class="col-4">Rating</div>
                            <div class="col-8">
                                {{ ': ' . $ratings->where('activity_id', $act->id)->first()->rating }}
                            </div>
                        </div>
                        <div class="row text-left div-hover-dark">
                            <div class="col-4">Comment</div>
                            <div class="col-8 ellipsis">
                                {{ ': ' . ($ratings->where('activity_id', $act->id)->first()->comment ?? 'None') }}
                            </div>
                        </div>
                    </div>
                    <!-- end details -->

                    <hr style="margin: 0px">
                </div>
                <?php ++$i ?>
            @endforeach
            <button class="button-r-reverse round-bottom w-100 pt-2 pb-2 upper" onclick="toggle_expand('finished')">show all</button>
        @else
            <h4 class="p-2">None</h4>
        @endif
    </div>
</div>

<div class="shadow-box mt-4">
    <div class="content pt-2">
        <h1>Participating</h1>
        <hr class="dark-hr">
        <?php $i = 1 ?>
        @foreach ($ongoing as $act)
            <div class="container {{ ($i >= 5) ? 'row-hidden ongoing' : '' }}">
                <!-- overview -->
                <div class="participant-list row">
                    <div class="col-4">
                        <a href="{{ route('activity.index', $act->id) }}">
                            <img src="{{ '/storage/' . $act->image }}" class="rounded" width="80px" alt="">
                        </a>
                    </div>

                    <div class="col-6 my-auto ellipsis">
                        <a href="{{ route('activity.index', $act->id) }}"><strong>{{ $act->title }}</strong>
                        </a>
                    </div>

                    <button class="button-b-reverse col-2 my-auto" onclick="toggle_details('{{ $act->id }}')">
                        &darr;
                    </button>

                </div>
                <!-- end overview -->

                <!-- details -->
                <div class="container" style="display: none" id="{{ 'act' . $act->id }}">
                    <div class="row text-left div-hover-dark">
                        <div class="col-4">Sponsor</div>
                        <div class="col-8">
                            <a href="{{ route('profile.index', $act->sponsor->user->profile->id) }}">
                                {{ ': ' . $act->sponsor->user->profile->nickname }}
                            </a>
                        </div>
                    </div>
                    <div class="row text-left div-hover-dark">
                        <div class="col-4">Description</div>
                        <div class="col-8 ellipsis">{{ ': ' . $act->description }}</div>
                    </div>
                    <div class="row text-left div-hover-dark">
                        <div class="col-4">Concerns</div>
                        <div class="col-8">{{ ': ' . $act->concern }}</div>
                    </div>
                    <div class="row text-left div-hover-dark">
                        <div class="col-4">Budget</div>
                        <div class="col-8">{{ ': ' . $act->budget }}</div>
                    </div>
                </div>
                <!-- end details -->

                <hr style="margin: 0px">
            </div>
            <?php ++$i ?>
        @endforeach
        <button class="button-b-reverse round-bottom w-100 pt-2 pb-2 upper" onclick="toggle_expand('ongoing')">show all</button>
    </div>
</div>
