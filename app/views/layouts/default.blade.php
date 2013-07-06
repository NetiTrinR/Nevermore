<!doctype html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
    	<title>Nevermore - {{ $title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="author" content="Michael Manning">
		{{--- le styles -}}
		{{ HTML::Style('css/bootstrap.min.css') }}
		<style type="text/css">
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
					<a class="brand" href="{{ URL::route('home') }}">Nevermore</a>
				</div>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li {{ if (stripos($_SERVER['REQUEST_URI'],'/forum/') !== false) {echo 'class="active"';} }}>
							<a href="{{ URL::route('forum.index') }}">Forum</a></li>
						<li {{ if (stripos($_SERVER['REQUEST_URI'],'/calender/') !== false) {echo 'class="active"';} }}>
							<a href="{{ URL::route('calender.index')}}">Calender</a></li>
						<li {{ if (stripos($_SERVER['REQUEST_URI'],'/shop/') !== false) {echo 'class="active"';} }}>
							<a href="{{ URL::route('shop.index') }}">Shop</a></li>
						<li {{ if (stripos($_SERVER['REQUEST_URI'],'/donate/') !== false) {echo 'class="active"';} }}>
							<a href="{{ URL::route('donation.index') }}">Donations</a></li>
					</ul>
					<ul class="nav pull-right">
						@if (Sentry::check())
							{{-- Logged in --}}
							<li><a href="{{URL::route('logout')}}">Sign Out</a></li>
							<li class="divider-vertical"></li>
							<li>
								You are <a  href="{{ URL::route('user.'.Sentry::getUser())}}">{{Sentry::getUser()}}</a>
								<a href="{{URL::route('user.edit')}}"><i class="icon-cog icon-white"></i></a>
							</li>
						@else
							{{-- Logged out --}}
							<li><a href="{{ URL::user.signup }}">Sign Up</a></li>
					        <li class="divider-vertical"></li>
					        <li class="dropdown">
					        	<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
					            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
					              {{-- Loggin form --}}
									{{Form::open('user.login')}}
										{{Form::token()}}
										{{-- username field --}}
										{{Form::text('email', array('placeholder' => 'Email'))}}
										{{-- password field --}}
										{{Form::password('password', array('placeholder'=>'Password'))}}
										{{Form::label('remember', array('class'=>'checkbox'))}}
										{{Form::checkbox('remember')}} Remember me?
										{{-- login button --}}
										{{Form::submit('Login', array('class'=>'btn'))}}
									{{Form::close()}}
					            </div>
					        </li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<div class="container fluid">

			@yeild('content')

			{{-- le Footer --}}
			@section('footer')
			<hr>
			<div class="span2"><p>Blha Blah bahr nevermore blahfg gsjkugngh &copy;</p></div>
			@yield_section

		</div>
		{{-- le javascript --}}
		{{ HTML::Script('js/jQuery-1.10.1.min.js') }}
		{{ HTML::Script('js/bootstrap.min.js') }}
		<script type="text/javascript">
			@section('javascript')
			$(document).ready(function() {
			  // Setup drop down menu
			  $('.dropdown-toggle').dropdown();
			 
			  // Fix input element click problem
			  $('.dropdown input, .dropdown label').click(function(e) {
			    e.stopPropagation();
			  });
			});
			@yeild_section
		</script>
	</body>
</html>