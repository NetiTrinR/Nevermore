@if(!Sentry::check())
	<div class="jumbotron">
		<h2>Welcome to Nevermore!</h2>
		<p class="tabbed">
			{{ Helper::get_flavor() }}
		</p>
		<p><a href="{{ URL::to('/user/register') }}" class="btn btn-primary btn-lg">Sign up</a></p>
	</div>
@endif