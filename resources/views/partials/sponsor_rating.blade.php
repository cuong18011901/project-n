<!-- rate input -->
@if (isset($show_rate))
	<div class="mt-3 upper" style="font-size: 18px">
	    <strong>{{ isset($already_rated) ? 'your rating for this sponsor' : 'rate this sponsor' }}</strong>
	</div>

	<div class="shadow-box">
	    <div class="wrapper" style="margin-top: 10px; margin-bottom: auto;">                                
	        @auth
	            @if (!isset($already_rated))
	                <form action="{{ route('sponsorRating.store') }}" method="POST">
	                    @csrf

	                    <div class="row form-group align-items-baseline">
	                        <div class="col-2 text-right">RATING</div>
	                        <select class="col-3 form-control" name="rating" id="rating">
	                            @for ($i = 1; $i <= 5; ++$i)
	                                <option value="{{ $i }}">{{ $i }}</option>
	                            @endfor
	                        </select>
	                    </div>

	                    <div class="form-group row shadow-textarea align-items-baseline">
	                        <div class="col-2 text-right">COMMENT</div>
	                        <textarea class="col-9 form-control z-depth-1" name="comment" id="comment" rows="3" placeholder="Write your thoughts about sponsor..."></textarea>
	                        
	                        @error('comment')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
	                    </div>
	                    <div align="middle">
	                        <input type="hidden" id="sponsor_id" name="sponsor_id" value="{{ $sponsor->id }}">
	                        <input type="submit" class="button-b-reverse button-s">
	                    </div>
	                </form>
	            @else
	                <div class="row">
	                	<div class="col-3 text-center">
	                		<img class="mb-2" src="{{ '/storage/' . $auth->profile->image }}" width="100px" alt="">
	                		<a class="upper" href="{{ route('profile.index', $auth->id) }}">
	                			<strong>{{ $auth->profile->nickname }}</strong>
	                		</a>
	                	</div>
	                	<div class="col-9 text-center">
	                		<div class="row">
			            		<div class="col-4 upper">rating</div>
			            		<div class="col-8 upper">comment</div>
	                		</div>
	                		
	                		<hr style="margin: 0px">
	                		
	                		<div class="row pt-2">
			            		<div class="col-4 upper">{{ $sponsor_rating->rating }}</div>
			            		<div class="col-8 upper">{{ $sponsor_rating->comment ?? 'None' }}</div>
	                		</div>
	                	</div>
	                </div>

					<!-- edit -->
					<form action="{{ route('sponsorRating.update') }}" id="patch-form" style="display: none" method="POST">
	                    @csrf
	                    @method('PATCH')

	                    <hr>

	                    <div class="row form-group align-items-baseline">
	                        <div class="col-2 text-right">RATING</div>
	                        <select class="col-3 form-control" name="rating" id="rating">
	                            @for ($i = 1; $i <= 5; ++$i)
	                                <option value="{{ $i }}">{{ $i }}</option>
	                            @endfor
	                        </select>
	                    </div>

	                    <div class="form-group row shadow-textarea align-items-baseline">
	                        <div class="col-2 text-right">COMMENT</div>
	                        <textarea class="col-9 form-control z-depth-1" name="comment" id="comment" rows="3" placeholder="Write your thoughts about sponsor..."></textarea>
	                        
	                        @error('comment')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
	                    </div>
	                    <div align="middle">
	                        <input type="hidden" id="sponsor_id" name="sponsor_id" value="{{ $sponsor->id }}">
	                        <input type="submit" class="button-b-reverse button-s">
	                    </div>
	                </form>
					<!-- end edit -->

	            @endif
	        @else
	            <div align="center">
	                <a href="{{ route('login') }}">
	                    <button class="button-b-reverse button-s w-100">Login to rate this Sponsor</button>
	                </a>
	            </div>
	        @endauth
	    </div>
	    @if (isset($already_rated))
	        <button class="w-100 button-b-reverse upper round-bottom pb-2 pt-2" onclick="toggle_patch()">edit</button>
	    @endif
	</div>
@endif
<!-- end rate input -->

<div class="mt-4 upper" style="font-size: 18px">
    <strong>ratings for this sponsor</strong>
</div>

<div class="shadow-box">
	<div class="wrapper" style="margin-top: 10px">
		@if ($ratings->count() === 0)
			<h3 class="upper">No rating has been added for this sponsor</h3>
		@else
			@foreach($ratings as $rating)
				<div class="row div-hover-dark pt-2 mb-1">
					
					<div class="col-3 text-center">
						<img src="{{ '/storage/' . $rating->profile->image }}" width="100px" alt="">
						<a class="upper" href="{{ route('profile.index', $rating->profile->id) }}">
		        			<strong>{{ $rating->profile->nickname }}</strong>
		        		</a>
					</div>

					<div class="col-9">
						<strong>Rating: </strong> {{ $rating->rating }}
						<hr style="margin: auto">
						<strong>Comment: </strong> {{ $rating->comment ?? 'None' }}
					</div>
				</div>

				<hr style="margin: auto" class="mb-2">
			@endforeach
			{{ $ratings->links() }}

		@endif
	</div>
</div>

<script type="text/javascript">
	function toggle_patch() {
		$('#patch-form').slideToggle(250);
	}
</script>