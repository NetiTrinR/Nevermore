@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-lg-4 well">
			<h4>{{ $userData->username }}</h4>
			<img src="{{ Helper::get_gavatar($userData->email, 80, 'mm', 'pg') }}" class="img-rounded"><br /><br />
			<ul class="list-unstyled">
					<li>IGN: {{ $userData->mcname }}</li>
				@if($userData->show_email)
					<li>Email: <a href="mailto:{{ $userData->email }}" class="text-warning">{{ $userData->email }}</a></li>
				@endif
				@if($userData->show_dob)
					<li>Age: {{ Carbon::createFromFormat('Y-m-d', $userData->dob)->diffInYears() }}</li>
				@endif
				@if($userData->show_loc)
				<li>Location: {{ $userData->location }}</li>
				@endif
			</ul>
		</div>
		<div class="col-lg-8">
			<ul id="userTabs" class="nav nav-tabs">
				<li class="active"><a href="#home" class="tab1" data-toggle="tab">Home</a></li>
				<li><a href="#thread" class="tab2" data-toggle="tab">Threads</a></li>
				<li><a href="#tag" class="tab3" data-toggle="tab">Tags</a></li>
				@if(Sentry::check())
					@if(Sentry::getUser()->username == $userData->username || Sentry::getUser()->hasAnyAccess(['admin']))
						<li><a href="{{URL::to('user/'.$userData->username.'/edit')}}">Edit</a></li>
					@endif
				@endif
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="home">
					@if($userData->show_micro)
						@if(Sentry::check())
							@if($userData->show_post)
								<h5>Post on {{ $userData->username }}'s Profile</h5>
								<form action="{{ URL::to('user/'.$userData->username.'/profile')}}" method="post" >
									{{ Form::token() }}
									<div class="row">
										<div class="col-lg-12">
											<div class="control-group {{ ($errors->has('body') ? 'has-error' : '') }}">
						            			<div class="form-group">
						            				<textarea class="form-control" style="height: 50px; resize:vertical;" name="body">{{ Request::old('body') }}</textarea>
														{{ ($errors->has('body')? '<ul><li>'.$errors->first('body').'</li><ul>': '') }}
						            			</div>
						       				</div>
											<div class="form-actions">
												<input class="pull-right btn btn-primary" type="submit" value="Post"/>
											</div>
										</div>
									</div>
								</form>
							@endif
						@endif
						<div id="micro" style="padding-top:15px;" class="col-lg-12">
							@if(count($replyData)>0)
								@foreach($replyData as $reply)
								 	<div class="row">
						 				<div class="col-lg-1">
						 					<div class="row"><img src="{{ Helper::get_gavatar($reply->email, 45, 'mm', 'pg') }}" class="img-rounded"></div>
						 					<div class="row">{{$reply->username}}</div>
						 				</div>
						 				<div class="col-lg-10">
						 					<div class="panel panel-default">
									 			<div class="panel-body">
									 				{{$reply->body}}
									 			</div>
								 			</div>
								 		</div>
								 	</div>
								@endforeach
							@else
								<p>This user hasn't posted any micro blogs yet!</p>
							@endif
						</div>
					@else
						<div style="padding-top:15px;" class="col-lg-12">
							<p>This user doesn't have micro blogs enabled.</p>
						</div>
					@endif
				</div>
				<div class="tab-pane" id="thread">
					<div style="padding-top:15px;" class="col-lg-12">
						@if(count($tags)>0)
							@foreach($tags as $tag)
								<a href="{{ URL::to('/forum/'.$tag->id.'/') }}"><span class="label label-default">{{$tag->name}}</span></a>
							@endforeach
						@else
							<p>This user hasn't made any threads yet!</p>
						@endif
					</div>
				</div>
				<div class="tab-pane" id="tag">
					<div style="padding-top:15px;" class="col-lg-12">
						@if(count($tags)>0)
							@foreach($tags as $tag)
								<a href="{{ URL::to('/forum/tag/'.$tag->name.'/') }}"><span class="label label-default">{{$tag->name}}</span></a>
							@endforeach
						@else
							<p>This user hasn't made any tags yet!</p>
						@endunless
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection