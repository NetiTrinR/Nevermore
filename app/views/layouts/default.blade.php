<?php
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="author" content="Michael Manning">
		<title>{{(isset($title)? "$title - Nevermore" : "Nevermore")}}</title>
		{{ HTML::Style('css/stylesheet.css') }}
		<style>
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.tabbed{
				position: relative;
				left: 25px;
			}
			.content{
				min-height:450px;
				height:auto !important;
				height:450px; 
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ URL::Route('hello') }}">Nevermore</a>
			</div>
			   <div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a {{ (Request::is('home')? 'class="active' : '') }} href="{{ URL::Route('home') }}">Home</a></li>
				  	<li><a {{ (Request::is('forum')? 'class="active"': '') }} href="{{ URL::Route('forum') }}">Forum</a></li>
					<li class="disabled"><a {{ (Request::is('calendar')? 'class="active"': '') }} href="#">Calendar</a></li>
					<li><a {{ (Request::is('shop')? 'class="active"': '') }} href="{{ URL::Route('shop') }}">Shop</a></li>
					@if(Sentry::check())
						@if(Sentry::getUser()->hasAnyAccess(['admin']))
							<li><a {{ (Request::is('admin')? 'class="active"':'' ) }} href="{{ URL::Route('admin') }}">Admin</a></li>
						@endif
					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if(Sentry::check())
						<li><a class="loginNav" href="{{ URL::Route('logout') }}">Logout</a></li>
						<li class="divider-vertical"></li>
						<li><a class="loginNav" href="{{ URL::to('/user/'.Sentry::getUser()['username'].'/profile') }}"><span class="glyphicon glyphicon-user"></span> {{ Sentry::getUser()['username'] }}</a></li>
						
						<li><a class="loginNav" href="{{ URL::to('/user/'.Sentry::getUser()['username'].'/edit') }}"><span class="glyphicon glyphicon-cog"></span></a></li>
					@else
						<li><a {{ (Request::is('/user/register')? 'class="active"': '') }} href="{{ URL::to('/user/register') }}">Sign Up</a></li>
				        @if(Request::is('/user/login'))
							<li><a class="active" href="#">Sign In</a><li>
				        @else
					        <li><a href="{{ URL::to('/user/login') }}">Sign in</a></li>
				        @endif
			        @endif
				</ul>
			</div>
		</nav>
		<div class="container">
			<div id='notifications'>@include('elements.notifications')</div>
			@if(isset($jumbo)||isset($header))
				<div class="row">
					<div class="col-lg-offset-2 col-lg-8">
						@if(isset($header)&&!empty($header))
							@include('elements.header')
						@endif
						@if(isset($jumbo)&&$jumbo==true)
							@include('elements.jumbo')
						@endif
					</div>
				</div>
			@endif
			<div class="row content">
				<div class="col-lg-2">
					@yield('leftSide')
					
				</div>
				<div class="col-lg-8">
					@yield('content')

				</div>
				<div class="col-lg-2">
					@yield('rightSide')
					
				</div>
			</div>
			@if(isset($footer)&&$footer==false)
			@else
				<div class="row bs-footer">
					<hr>
					<footer>
						<div class="col-lg-3">
							<div class="list-group">
									<a class="list-group-item" href="{{ URL::Route('about') }}">About Us</a>
									<a class="list-group-item" href="{{ URL::Route('faq') }}">FAQ</a>
									<a class="list-group-item" href="{{ URL::Route('privacy') }}">Privacy Policy</a>
									<a class="list-group-item" href="{{ URL::Route('rules') }}">Rules</a>
									<a class="list-group-item" href="{{ URL::Route('terms') }}">Terms and Conditions</a>
									<a class="list-group-item" href="{{ URL::Route('bug') }}">Report a bug</a>
								</div>
						</div>
						
						<div class="col-lg-offset-6 col-lg-3">
							<div class="row">
								<ul class="list-inline">
									<li>
										<a href="http://twitter.com/NevermoreServer"><span class="glyphicon glyphicon-twitter"></span>Twit</a>
									</li>
									<li>
										<a href="http://www.facebook.com/NeverMoreServer"><span class="glyphicon glyphicon-facebook"></span>FB</a>
									</li>
									<li>
										<a href="http://www.youtube.com"><span class="glyphicon glyphicon-youtube"></span>YT</a>
									</li>
								</ul>
							</div>
							<div class="row">
								<small>
									<p>Caffinated Addicts &copy; 2013-&infin;<br />
										Implimenting <a href="http://laravel.com/" class="text-info">Laravel 4.0</a>, expressing elegance.<br />
										<?php
											$time = microtime();
											$time = explode(' ', $time);
											$time = $time[1] + $time[0];
											$finish = $time;
											$total_time = round(($finish - $start), 4);
										?>
										This page loaded in {{ $total_time }}. Your IP is<br />{{ $_SERVER['REMOTE_ADDR'] }}
									</p>
								</small>
							</div>
						</div>
					</footer>
				</div>
			@endif
		</div>

		<script src="{{ URL::to('/js/jquery-1.10.1.min.js') }}"></script>
		<script src="{{ URL::to('/js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::to('/js/respond.min.js') }}"></script>
		<script src="{{ URL::to('/js/chosen.jquery.min.js')}}"></script>
		<script src="{{URL::to('/js/bootstrap-switch.min.js')}}"></script>
		<!-- Markdown requires -->
		<script src="{{ URL::to('/js/markdown.js') }}"></script>
		<script src="{{ URL::to('/js/to-markdown.js') }}"></script> <!-- I think we don't need this but it is still a dependency for bootstrap-markdown.js -->
		<script src="{{ URL::to('/js/bootstrap-markdown.js') }}"></script>
		<script src="{{ URL::to('/js/flash.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				@yield('javascript')
				$('.tooltips').tooltip();
			});
			@include('elements.js-functions')
		</script>
		@yield('modal')
	</body>
</html>