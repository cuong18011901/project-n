@if (session()->has('success_message'))
	<div align="center">
		<div style="width: 300px">
			<div class="message success-message">
				<strong>{{ session()->get('success_message') }}</strong>
			</div>
		</div>
	</div>
@endif
@if (session()->has('error_message'))
	<div align="center">
		<div style="width: 300px">
			<div class="message error-message">
				<strong>{{ session()->get('error_message') }}</strong>
			</div>
		</div>
	</div>
@endif
@if (session()->has('warning_message'))
	<div align="center">
		<div style="width: 300px">
			<div class="message warning-message">
				<strong>{{ session()->get('warning_message') }}</strong>
			</div>
		</div>
	</div>
@endif