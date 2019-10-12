<div class="col-3">
	<div class="left-panel shadow-box">
		<div class="content pt-2">
			<h1>Quick actions</h1>
			<hr class="dark-hr">
			@if (isset(Auth::user()->sponsor))
				<a href="{{ route('sponsor.new') }}">
					<div class="action-option">New activity</div>
				</a>
			@endif
			<div class="action-option">Option</div>
			<div class="action-option">Option</div>
			<div class="action-option">Option</div>
			<div class="action-option">Option</div>
			<div class="action-option">Option</div>
			<hr>
		</div>
	</div>
</div>