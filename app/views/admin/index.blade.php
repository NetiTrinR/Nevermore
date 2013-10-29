@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<b>Website Tools</b>
				<ul class='list-unstyled'>
					<li><a href="{{ URL::to('/admin/users/')}}">Users</a></li>
					<li><a >Website Permissions</a></li>
					<li><a >Throttling</a></li>
					<li><a href="{{ URL::to('/admin/threads/')}}">Thread Management</a></li>
					<li><a >Tags</a></li>
					<li><a >Purchases</a></li>
					<li><a >Items</a><li>
				</ul>
				<b>Server tools</b>
				<ul class="list-unstyled">
					<li><a >Server Console</a></li>
					<li><a >Throttling</a></li>
				</ul>
			</div>
		</div>
	</div>
@endsection