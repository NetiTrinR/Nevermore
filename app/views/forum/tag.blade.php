@extends('layouts.default')
@section('rightSide')
	<h3>Statistics</h3>
	<hr style="margin:0px;"/>
	<p>
		<ul class="list-unstyled">
			<li>Created: {{Carbon::parse($tag->created_at)->diffForHumans()}}</li>
			<li>Created by: <a href="{{URL::to('/user/'.$tag->username.'/profile')}}">{{$tag->username}}</a></li>
			<li>Implimented: {{$tag->threadcount}}</li>
			<li>Last used: {{Carbon::parse($tag->lastused)->diffForHumans()}}</li>
		</ul>
	</p>
	@if(Sentry::check())
		<a href="#" data-toggle="modal" data-target="#tag-modal" class="btn-block btn btn-info">New Tag</a>
		@if(Sentry::getUser()->hasAnyAccess(['admin'])||Sentry::getUser()->id == $tag->created_by)
			<a href="{{URL::to('forum/delete/tag/'.$tag->id)}}" class="btn-block btn btn-warning">Delete Tag</a>
		@endif
		<a href="#" class="btn-block btn btn-default">Flag Tag</a>
		@if(Sentry::getUser()->hasAnyAccess(['admin']))
			<a href="#" class="btn-block btn btn-default">Blacklist Tag</a>
		@endif
	@else
		<div class="well"><a href="{{URL::route('login')}}">Login</a> to create a tag!</div>
	@endif
	<center>
		<!-- <ul class="pagination pagination-sm">
		  <li><a href="#">&laquo;</a></li>
		  <li><a href="#">1</a></li>
		  <li><a href="#">2</a></li>
		  <li><a href="#">3</a></li>
		  <li><a href="#">&raquo;</a></li>
		</ul> -->
	</center>
@endsection
@section('content')
	@foreach($threads as $thread)
		<div class="panel panel-default" style="margin-bottom:5px;">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-1"><a href='{{URL::to("user/".$thread->first['username']."/profile")}}'><img src="{{Helper::get_gavatar($thread->first['email'],50)}}" class="img-rounded"/></a></div>
					<div class="col-lg-9">
						<a href="{{URL::to("forum/".$thread->id)}}" class="text-muted">{{$thread->name}}</a><br />
						<small><a href='{{URL::to("user/".$thread->first['username']."/profile")}}' class="text-muted">{{$thread->first['username']}}</a> &bull; {{$thread->count}} Posts</small>
					</div>
					<div class="col-lg-2 well" style="margin-bottom:0px;padding:10px;">
						<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="{{$thread->last['created_at']}}">
							{{Carbon::parse($thread->last['created_at'])->diffForHumans()}}
						</a><br />
						{{$thread->last['username']}}
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endsection
@section('modal')
	@include('forum.createTag')
@endsection
@section('javascript')
	$('#tag-submit').on('click', function(e){
		e.preventDefault();
		// console.log($('#tag').val());
		$.ajax({
			type: "POST",
			url: "{{URL::to('forum/createTag')}}",
			data: {tags:$('#tag').val()},
			success: function(output){
				switch(output.outcome){
					case 1://Success
						$('#tag').closest('.form-group').attr('class','form-group has-success');
					break;
					case 2://Error
						$('#tag').closest('.form-group').attr('class','form-group has-error');
					break;
					case 3://Warning
						$('#tag').closest('.form-group').attr('class','form-group has-warning');
						$('#tag').val('');
					break;
				}
				$('#tag-help-block').closest('.help-block').html(output.msg);
			}
		});
	});
@endsection