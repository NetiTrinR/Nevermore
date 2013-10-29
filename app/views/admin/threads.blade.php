@extends('layouts.default')
@section('content')
	<div class="table-responsive">
		<h4>Threads</h4>
		<table class="table table-striped">
			<tr>
				<td>#</td>
				<td>Name</td>
				<td>Category</td>
				<td>Created By</td>
				<td>Created At</td>
				<td>Replies</td>
				<td>Status</td>
				<td>Actions</td>
			</tr>
			@foreach($threads as $thread)
				<tr>
					<td>{{$thread->id}}</td>
					@if($thread->cat_id == 1)
						<td><a href="{{URL::to('/forum/'.$thread->id)}}">{{$thread->name}}</a></td>
					@elseif($thread->cat_id == 2)
						<td><a href="{{URL::to('/admin/forum/'.$thread->id)}}">{{$thread->name}}</a></td>
					@elseif($thread->cat_id == 3)
						<td><a href="{{URL::to('/user/'.$thread->name.'/profile')}}">{{$thread->name}}'s Microblog</a></td>
					@else
						<td>{{$thread->name}}</td>
					@endif
					<td>{{$thread->cat_name}}</td>
					<td>{{$thread->username}}</td>
					<td><a href='#' class="tooltips text-muted" data-toggle="tooltip" title="{{$thread->created_at}}">{{Carbon::parse($thread->created_at)->DiffForHumans()}}</a></td>
					<td>{{$thread->replies}}</td>
					<td>
						@if($thread->locked_at != null)
							Locked
						@elseif($thread->deleted_at != null)
							Deleted
						@else
							Active
						@endif
					</td>
					<td>
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Lock"><span class="glyphicon glyphicon-lock"></span></a>&nbsp;
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection
