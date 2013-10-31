@extends('layouts.default')
@section('rightSide')
	<center>
		<form style="padding-bottom:4px;">
			<div class="input-group">
				<input type="text" value="" class="form-control" placeholder="Search">
				<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
			</div>
		</form>
		<a href="{{ URL::to('/forum/create') }}" class="btn-block btn btn-primary">New Thread</a>
		@if(Sentry::check())
			<a href="#" data-toggle="modal" data-target="#tag-modal" class="btn-block btn btn-info">New Tag</a>
			<a href="#" class="btn-block btn btn-default">My stuff</a>
		@endif
		<a href="#" class="btn-block btn btn-warning">Gallery</a>
	</center>
@endsection
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<ul id="userTabs" class="nav nav-tabs">
				<li><a href="#tag-thread" class="tab1" data-toggle="tab">Top Tags</a></li>
				<li class="active"><a href="#recent" class="tab2" data-toggle="tab">Recent</a></li>
				<li><a href="#trend" class="tab3" data-toggle="tab">Trending</a></li>
				<li><a href="#bump" class="tab4" data-toggle="tab">Bumped</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane" id="tag-thread" style="margin-top:5px;"></div>
				<div class="tab-pane active" id="recent" style="margin-top:5px;">
					@foreach($recent as $thread)
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
				</div>
				<div class="tab-pane" id="trend" style="margin-top:5px;">
					@foreach($trend as $thread)
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
				</div>
				<div class="tab-pane" id="bump" style="margin-top:5px;">
					@foreach($bumped as $thread)
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
				</div>
			</div>
		</div>
	</div>
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