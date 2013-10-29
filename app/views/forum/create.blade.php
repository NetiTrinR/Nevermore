@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Create a New Thread</h1>
			</div>
			<div class="panel-body">
				<form role="form" action="{{ URL::to('forum/create')}}" method="post">
					{{ Form::token() }}
					<div class="form-group {{ ($errors->has('title') ? 'has-error' : '') }}">
						<label for="title" class="control-label">Thread Name</label>
			            <input name="title" id="title" value="{{ Request::old('title') }}" type="text" class="form-control col-lg-7" placeholder="Enter Title here"><br />
			            <span class="help-block">{{ ($errors->has('title')? $errors->first('title'): '') }}</span>
			        </div>
			        <div class="form-group {{ ($errors->has('subject') ? 'has-error' : '') }}">
						<label for="subject" class="control-label">Thread Subject</label>
			            <input name="subject" id="subject" value="{{ Request::old('subject') }}" type="text" class="form-control col-lg-7" placeholder="Thread Subject"><br />
			            <span class="help-block">{{ ($errors->has('subject')? $errors->first('subject'): '') }}</span>
			        </div>
			        <div class="form-group {{ ($errors->has('tags') ? 'has-error' : '') }}">
						<label for="tags" class="control-label">Thread Tags</label>
			            <select id="chosenTags" multiple name="tags[]" class="col-lg-7 chosen-select" data-placeholder="Tags">
			            </select>
			            <br />
			           	<small>Don't see a tag? Create one <a href="#" class="tooltips" data-toggle="modal" data-target="#tag-modal" data-placement="bottom" rel="tooltip" title="You won't be redirected.">here</a>.</small>
			            <span class="help-block">{{ ($errors->has('tags')? $errors->first('tags'): '') }}</span>
			        </div>
					<div class="form-group {{ ($errors->has('body')? 'has-error':'') }}">
						<label for="body" class="control-label">Content</label>
						<textarea name="body" id="body" class="form-control" data-provide="markdown">{{ Request::old('body') }}</textarea>
						<span class="clearfix help-block ">{{ ($errors->has('body')? $errors->first('body'):'') }}</span>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('modal')
	@include('forum.createTag')
@endsection
@section('javascript')
	updateChosenTags();
	$('.chosen-select').chosen({});
	$('#tag-submit').on('click', function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "{{URL::to('forum/createTag')}}",
			data: {tag:$('#tag').val()},
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
				updateChosenTags();
			}
		});
	});
@endsection