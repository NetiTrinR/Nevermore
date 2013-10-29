@extends('layouts.default')

@section('content')
<div class="col-lg-offset-3 col-lg-5">
	<h3>Register New Account</h3>
	<div class="well">
		<form role="form" action="{{ URL::to('user/register')}}" method="post">
	        {{ Form::token() }}
	        <h5>Personal Information</h5>
	        <span class="help-block">Please read our privacy policy <a href="{{ URL::to('privacy') }}">here.</a>  We remind you that we will never disclose your information to a third party or to other players.  All information is gathered under the intent to further facilitate you.</a></span>
			<div class="form-group {{ ($errors->has('first_name') ? 'has-error' : '') }}">
	            <input name="first_name" id="first_name" value="{{ Request::old('first_name') }}" type="text" class="form-control col-lg-7" placeholder="First Name"><br />
	           	<span class="help-block">{{ ($errors->has('first_name')? $errors->first('first_name'): '') }}</span>
	        </div>

			<div class="form-group {{ ($errors->has('last_name') ? 'has-error' : '') }}">
	            <input name="last_name" id="last_name" value="{{ Request::old('last_name') }}" type="text" class="form-control col-lg-7" placeholder="Last Name"><br />
	            <span class="help-block">{{ ($errors->has('last_name')? $errors->first('last_name'): '') }}</span>
	        </div>
			<div class="input-group {{ ($errors->has('dob') ? 'has-error' : '') }}">
				<span class="glyphicon glyphicon-calendar input-group-addon"></span>
	            	<!-- <div class="date" id="dp" data-date-viewmode="years" data-date="{{ date('m-d-Y') }}" data-date-format="mm-dd-yyyy"> -->
						<input name="dob" id="dob" data-date-viewmode="years" data-date="{{ date('m-d-Y') }}" data-date-format="mm-dd-yyyy" value="{{ Request::old('dob') }}" type="date" class="form-control col-lg-7" placeholder="Date of Birth">
					<!-- </div> -->
			</div>
			<span class="help-block {{ ($errors->has('dob') ? 'text-danger' : '') }}">{{ ($errors->has('dob')? $errors->first('dob'): '') }}</span>
			
			<h5>Account Information</h5>
			<div class="form-group {{ ($errors->has('username') ? 'has-error' : '') }}">
	            <input name="username" id="username" value="{{ Request::old('username') }}" type="text" class="form-control col-lg-7" placeholder="Username"><br />
	            <span class="help-block">{{ ($errors->has('username') ? $errors->first('username') : '') }}</span>
	        </div>

			<div class="form-group {{ ($errors->has('mcname') ? 'has-error' : '') }}">
	            <input name="mcname" id="mcname" value="{{ Request::old('mcname') }}" type="text" class="form-control col-lg-7" placeholder="Minecraft IGN"><br />
	            <span class="help-block">{{ ($errors->has('mcname') ? $errors->first('mcname') : '') }}</span>
	        </div>

	        <div class="form-group {{ ($errors->has('email') ? 'has-error' : '') }}">
	            <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="form-control col-lg-7" placeholder="E-mail"><br />
	            <span class="help-block">{{ ($errors->has('email') ? $errors->first('email') : '') }}</span>
	        </div>

	        <div class="form-group {{ ($errors->has('email_confirmation') ? 'has-error' : '') }}">
	            <input name="email_confirmation" id="email_confirmation" value="{{ Request::old('email_confirmation') }}" type="text" class="form-control col-lg-7" placeholder="Confirm Email"><br />
	            <span class="help-block">{{ ($errors->has('email_confirmation') ? $errors->first('email_confirmation') : '') }}</span>
	        </div>

			<div class="form-group {{ ($errors->has('password') ? 'has-error' : '') }}">
				<input name="password" value="" type="password" class="form-control col-lg-7" placeholder="Password"><br />
				<span class="help-block">{{ ($errors->has('password') ? $errors->first('password') : '') }}</span>
			</div>

			<div class="form-group {{ ($errors->has('password_confirmation') ? 'has-error' : '') }}">
				<input name="password_confirmation" value="" type="password" class="form-control col-lg-7" placeholder="Confirm Password"><br />
				<span class="help-block">{{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}</span>
			</div>
			<br />
			<span class="help-block">
				By clicking the register button means you accept Nevermore's <a href="{{ URL::Route('privacy') }}">Privacy Policy</a>, <a href="{{ URL::Route('terms')}}">Terms and Conditions</a>, and will uphold the <a href="{{ URL::Route('rules') }}">rules</a> both on the minecraft server and on the website.
			</span>

			<div class="form-actions">
				<input class="btn-primary btn" type="submit" value="Register">
				<input class="btn-default btn " type="reset" value="Reset">
			</div>
		</form>
	</div>
</div>
@stop

@section('javascript')
	@parent
	$('#dob').datepicker();
@stop