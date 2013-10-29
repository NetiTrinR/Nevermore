@extends('layouts.default')
@section('content')
	<div class="table-responsive">
		<h4>Active Users</h4>
		<table class="table table-striped">
			<tr>
				<td>#</td>
				<td>Username</td>
				<td>Email</td>
				<td>Last Visited</td>
				<td>Created</td>
				<td>Actions</td>
			</tr>
			@foreach($users as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td><a href="{{ URL::to('user/'.$user->username.'/profile')}}" class="link-default">{{$user->username}}</a></td>
					<td>{{$user->email}}</td>
					<td><a href="#" class="tooltips text-muted" data-placement="right" data-toggle="tooltip" title="{{$user->last_login}}">{{Carbon::parse($user->last_login)->diffForHumans()}}</a></td>
					<td><a href="#" class="tooltips text-muted" data-placement="right" data-toggle="tooltip" title="{{$user->created_at}}">{{Carbon::parse($user->created_at)->diffForHumans()}}</a></td>
					<td>
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Suspend"><span class="glyphicon glyphicon-time"></span></a>&nbsp;
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Ban"><span class="glyphicon glyphicon-remove"></span></a>&nbsp;
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
			@endforeach
		</table>
		<h4>Past Users</h4>
		<table class="table table-striped">
			<tr>
				<td>#</td>
				<td>Username</td>
				<td>Email</td>
				<td>Deleted at</td>
				<td>Created</td>
				<td>Actions</td>
			</tr>
			@foreach($trash as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td><a href="{{ URL::to('user/'.$user->username.'/profile')}}" class="link-default">{{$user->username}}</a></td>
					<td>{{$user->email}}</td>
					<td><a href="#" class="tooltips text-muted" data-placement="right" data-toggle="tooltip" title="{{$user->deleted_at}}">{{Carbon::parse($user->deleted_at)->diffForHumans()}}</a></td>
					<td><a href="#" class="tooltips text-muted" data-placement="right" data-toggle="tooltip" title="{{$user->created_at}}">{{Carbon::parse($user->created_at)->diffForHumans()}}</a></td>
					<td>
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Restore"><span class="glyphicon glyphicon-repeat"></span></a>&nbsp;
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Destroy"><span class="glyphicon glyphicon-fire"></span></a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection
