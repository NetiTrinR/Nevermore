<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="author" content="Michael Manning">
		<title>{{ (isset($title))? "$title - Nevermore" : "Nevermore" }}</title>
		{{ HTML::Style('css/bootstrap.min.css') }}
		{{ HTML::Style('css/datepicker.css')}}
		<style>
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{{ URL::Route('home') }}" class="brand">Nevermore</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a {{ (Request::is('forum'))? 'class="active"': '' }} href="{{ URL::Route('forum') }}">Forum</a></li>
							<li><a {{ (Request::is('calender'))? 'class="active"': '' }} href="{{ URL::Route('calendar') }}">Calender</a></li>
							<li><a {{ (Request::is('shop'))? 'class="active"': '' }} href="{{ URL::Route('shop') }}">Shop</a></li>
							<li><a {{ (Request::is('donate'))? 'class="active"': '' }} href="{{ URL::Route('donate') }}">Donations</a></li>
						</ul>
						<ul class="nav pull-right">
							@if(Sentry::check())
								<li><a href="{{ URL::Route('logout') }}">Logout</a></li>
								<li><a href="{{ URL::to('user/profile/'.Sentry::getUser()) }}"><i class="icon-user icon-white"></i> {{ Sentry::getUser() }}</a><div class="divider-vertical"></div><a href="{{ URL::to('user/profile/'.Sentry::getUser().'/edit') }}"><i class="icon-cog icon-white"></i></a></li>
							@else
								<li><a {{ (Request::is('user/register'))? 'class="active"': '' }} href="{{ URL::Route('register') }}">Sign Up</a></li>
						        <li class="divider-vertical"></li>
						        @if(Request::is('user/login'))
									<li><a class="active" href="#">Sign In</a><li>
						        @else
							        <li class="dropdown">
							        	<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
							            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
											{{ Form::open(['url' => '/user/login']) }}
												{{ Form::token() }}
												{{ Form::text('email', '', ['placeholder' => 'Email']) }}
												{{ Form::text('pass', '', ['placeholder' => 'Password']) }}
												<label class='checkbox'>
													{{ Form::checkbox('remember', true, false) }} Remember me
												</label>
												{{ Form::submit('Login', ['class'=>'btn']) }}
											{{ Form::close() }}
							            </div>
							        </li>
						        @endif
					        @endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		{{-- Alerts here --}}
		
		<div class="container-fluid">
			@include('notifications')
			<div class="row-fluid">
				@yield('content')
			</div>
			<hr>
			<footer>
				<div class="span2">&copy; Nevermore</div>
				<div class="span2 pull-right">Other stuffs</div>
			</footer>
		</div>
		{{ HTML::Script('js/jQuery-1.10.1.min.js') }}
		{{ HTML::Script('js/bootstrap.min.js') }}
		{{ HTML::Script('js/bootstrap-datepicker.js') }}
		<script type="text/javascript">
			$(document).ready(function() {
				@section('javascript')
					$('.dropdown-toggle').dropdown();
					$('.dropdown input, .dropdown label').click(function(e) {
			    		e.stopPropagation();
			  		});
				@show
			});
		</script>
	</body>
</html>