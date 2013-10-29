@extends('layouts.default')

@section('leftSide')
<!-- 	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Gallery</h1>
			</div>
			<div class="panel-body">
				<center>
					<img src="{{ Helper::get_gavatar('netitrinr@gmail.com') }}" />
				</center>
			</div>
		</div>
	</div> -->
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">New Users</h1>
			</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					@if(!empty($newusers))
						@foreach($newusers as $newuser)
							<li>
								<a href="{{URL::to('/user/'.$newuser->username.'/profile')}}">{{$newuser->username}}</a>
							</li>
						@endforeach
					@else
						<li>We lack recent players.</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Wall of Shame</h1>
			</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					@if(!empty($shames))
						@foreach($shames as $shame)
							<li>
								<a href="{{URL::to('/user/'.$shame->username.')profile')}}">{{$shame->username}}</a>
							</li>
						@endforeach
					@else
						<li>The wall is shameless.</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
@endsection
@section('rightSide')
	<div class="row">
		<div class="panel panel-default" id="minecraft-status">
			<div class="panel-heading">
				<h1 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#minecraft-status" href="#minecraft-status-body">
			          Server Status
			        </a>
				</h1>
			</div>
			<div class="panel-collapse collapse in" id="minecraft-status-body">
				<div class="panel-body">
					<p id="serverStatus">
						Loading Server Status...
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Up Coming Events</h1>
			</div>
			<div class="panel-body">
				There are no scheduled events at this time.
			</div>
		</div>
	</div>
@endsection
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title">Announcements</h1>
				</div>
				<div class="panel-body">
					<p>
						@foreach($announcement as $thread)
							<div class="container">
								<a href="{{URL::to('forum/'.$thread->id)}}">{{$thread->name}}</a><br />
							</div>
						@endforeach
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">New Threads</h1>
				</div>
				<div class="panel-body">
					@foreach($recent as $thread)
						<div class="container">
							<a href="{{URL::to('forum/'.$thread->id)}}">{{$thread->name}}</a><br />
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">Trending Threads</h1>
				</div>
				<div class="panel-body">
					@foreach($bumped as $thread)
						<div class="container">
							<a href="{{URL::to('forum/'.$thread->id)}}">{{$thread->name}}</a><br />
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">Bumped Threads</h1>
				</div>
				<div class="panel-body">
					@foreach($trend as $thread)
						<div class="container">
							<a href="{{URL::to('forum/'.$thread->id)}}">{{$thread->name}}</a><br />
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection
@section('javascript')
	updateServerStatus();
@endsection