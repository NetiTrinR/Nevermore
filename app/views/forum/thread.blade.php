@extends('layouts.default')
@section('rightSide')
	<h3>Tags</h3>
	<hr style="margin:0px;"/>
	<p>
		@if(count($tags)>0)
			@foreach($tags as $tag)
				<a href="{{ URL::to('/tag/'.$tag->id.'/') }}"><span class="label {{  $tag->type==2?'label-info':'label-default'}}">{{$tag->name}}</span></a>
			@endforeach
		@else
			This thread has no tags!
		@endif
	</p>
	@if(Sentry::check())
		<a href="#body" class="btn-block btn btn-primary">Reply</a>
		@if(Sentry::getUser()->hasAnyAccess(['admin'])||Sentry::getUser()->id == $replyData[0]->created_by)
			<a href="{{URL::to('forum/delete/thread/'.$threadData->id)}}" class="btn-block btn btn-warning">Delete Thread</a>
		@endif
	@else
		<div class="well"><a href="{{URL::route('login')}}">Login</a> to post!</div>
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
	@foreach($replyData as $reply)
		<div id="{{$reply->id}}" class="row">
			<div class="col-lg-1">
				<center>
					<a class="text-muted" href="{{URL::to('user/'.Sentry::getUserProvider()->findById($reply->created_by)->username.'/profile')}}">
						<img src="{{ Helper::get_gavatar(Sentry::getUserProvider()->findById($reply->created_by)->email, 40, 'mm', 'pg') }}" class="img-rounded"><br />
						{{Sentry::getUserProvider()->findById($reply->created_by)->username}}
					</a>
				</center>
			</div>
			<div class="col-lg-11">
				<div class="panel panel-default" style="margin-bottom:5px;">
					<div class="panel-body reply-body">
						{{Helper::replaceAtReplies($markdown->transformMarkdown($reply->body))}}
					</div>
					<div class="panel-footer" style="padding:5px 15px;">
							<a href="#{{$reply->id}}" class="tooltips" data-toggle="tooltip" title="Permalink">#{{$reply->id}}</a>
							&bull;
							<a href="#" class="tooltips text-muted" data-toggle="tooltip" title="{{$reply->updated_at}}">{{Carbon::parse($reply->updated_at)->diffForHumans()}}</a>
						<div class="pull-right">
							@if(Sentry::check())
								@if(Sentry::getUser()->hasAnyAccess(['admin']))
									<a href="#">Edit</a> &bull; <a href="{{URL::to('forum/delete/reply/'.$reply->id)}}">Delete</a>
									&bull;
									<a href="#" class="reply" data-username="{{Sentry::getUserProvider()->findById($reply->created_by)->username}}">@reply</a>
									&bull;
									<a href="#" class="tooltips text-muted flag" data-toggle="tooltip" data-placement="bottom" title="Flag for inappropriate content"><span class="glyphicon glyphicon-flag"></span></a>
								@elseif(Sentry::getUser()->id == $reply->created_by)
									<a href="#">Edit</a> &bull; <a href="{{URL::to('forum/delete/reply/'.$reply->id)}}">Delete</a>
								@else
									<a href="#" class="reply" data-username="{{Sentry::getUserProvider()->findById($reply->created_by)->username}}">@reply</a>
									&bull;
									<a href="#" class="tooltips text-muted flag" data-flag='1' data-toggle="tooltip" data-placement="bottom" title="Flag for inappropriate content"><span class="glyphicon glyphicon-flag"></span></a>
								@endif
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<hr />
	@if(Sentry::check())
		@if(Sentry::getUser()->hasAnyAccess(['admin'])||($threadData->locked_at == null&&$threadData->deleted_at == null))
			<form role="form" action="{{URL::to('forum/reply')}}" method="post">
				{{ Form::token() }}
				{{ Form::hidden('thread_id', $threadData->id) }}
				{{ Form::hidden('user_id', Sentry::getUser()->id)}}
				<div class="form-group {{ ($errors->has('body')? 'has-error':'') }}">
					<label for="body" class="control-label">Reply</label>
					<textarea name="body" id="body" class="form-control" data-provide="markdown">{{ Request::old('body') }}</textarea>
					<span class="clearfix help-block ">{{ ($errors->has('body')? $errors->first('body'):'') }}</span>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		@endif
	@endif
@endsection
@section('javascript')
	$('.reply-body img').each(function(){
		$(this).css({'max-width': 300, 'max-height':300}).addClass('img-rounded').wrap('<p />');
	});
	var yt="http://www.youtube.com/v/";
	$("a[href^='http://www.youtube.com/watch?v=']").each(function(){
		var key;
		var href=$(this).attr("href");
		var i=href.indexOf("v");
		href=href.substring(i+2,href.length);
		i=href.indexOf("&");
		if(i>-1){
			key=href.substring(0,i);
			href=yt+key;
		}else{
			href=yt+href;
		}
		$(this).after("<p><a href='"+href+"' class='video'></a></p>");
	});
	$('.video').flash(
		{height: 300, width: 300},
		{ version: 8 },
		function(htmlOptions) {
			$this = $(this);
			htmlOptions.src = $this.attr('href');
			$this.before($.fn.flash.transform(htmlOptions));                        
		}
	);
	$('.video').remove();
	$('.reply').on('click', function(){
		$('#body').val($('#body').val()+'@'+$(this).data('username')+' ').focus();
	});
	$('.flag').on('click', function(e){
		e.preventDefault();
		// console.log('Flagging '+$(this).closest('.row').attr('id'));
		$.ajax({
			type: "POST",
			url: "{{URL::to('/forum/flag')}}",
			data: {flag:$(this).closest('.row').attr('id'),type:$(this).data('flag')},
			success:function(output){
				// console.log(output);
				//1 is success 2 is error
				if(output[0]==1){
					$('#notifications').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Success</h4>'+output[1]+'</div>');
				}else{
					$('#notifications').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Error</h4>'+output[1]+'</div>');
				}
				 $("html, body").animate({ scrollTop: 0 }, "slow");
			}
		});
	});
@endsection