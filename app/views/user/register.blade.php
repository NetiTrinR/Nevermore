@extends('layouts.default')

@section('content')
<div class="offset3 span5">
	<h3>Register New Account</h3>
	<div class="well">
		<form action="{{ URL::to('users/register') }}" method="post">
	        {{ Form::token() }}
	        <h5>Personal Information</h5>
	        <span class="help-block">Please read our privacy policy <a href="#">here.</a>  We remind you that we will never disclose your information to a third party or to other players.  All information is gathered under the intent to further facilitate you.</a></span>
			<div class="control-group {{ ($errors->has('first_name')) ? 'error' : '' }}" for="first_name">
	            <div class="controls">
	            	<input name="first_name" id="first_name" value="{{ Request::old('first_name') }}" type="text" class="span7 input-xlarge" placeholder="First Name">
	            	{{ ($errors->has('first_name')? $errors->first('first_name'): '') }}
	            </div>
	        </div>

			<div class="control-group {{ ($errors->has('last_name')) ? 'error' : '' }}" for="last_name">
	            <div class="controls">
	            	<input name="last_name" id="last_name" value="{{ Request::old('last_name') }}" type="text" class="span7 input-xlarge" placeholder="Last Name">
	            	{{ ($errors->has('last_name')? $errors->first('last_name'): '') }}
	            </div>
	        </div>

			<div class="control-group {{ ($errors->has('dob')) ? 'error' : '' }}" for="dob">
	            <div class="controls">
	            	<div class="input-append date" id="dp" data-date-viewmode="years" data-date="{{ date('m-d-Y') }}" data-date-format="mm-dd-yyyy">
						<input name="dob" id="dob" value="{{ Request::old('dob') }}" type="text" readonly="" class="span7 input-xlarge" placeholder="Date of Birth">
						<span class="add-on"><i class="icon-calendar"></i></span>
					</div>
				</div>
			</div>
			
			<h5>Account Information</h5>
			<div class="control-group {{ ($errors->has('username')) ? 'error' : '' }}" for="username">
	            <div class="controls">
	                <input name="username" id="username" value="{{ Request::old('username') }}" type="text" class="span7 input-xlarge" placeholder="Username">
	                {{ ($errors->has('username') ? $errors->first('username') : '') }}
	            </div>
	        </div>

			<div class="control-group {{ ($errors->has('mcname')) ? 'error' : '' }}" for="mcname">
	            <div class="controls">
	                <input name="mcname" id="mcname" value="{{ Request::old('mcname') }}" type="text" class="span7 input-xlarge" placeholder="Minecraft Username">
	                {{ ($errors->has('mcname') ? $errors->first('mcname') : '') }}
	            </div>
	        </div>

	        <div class="control-group {{ ($errors->has('email')) ? 'error' : '' }}" for="email">
	            <div class="controls">
	                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="span7 input-xlarge" placeholder="E-mail">
	                {{ ($errors->has('email') ? $errors->first('email') : '') }}
	            </div>
	        </div>

	        <div class="control-group {{ ($errors->has('email_confirmation')) ? 'error' : '' }}" for="email_confirmation">
	            <div class="controls">
	                <input name="email_confirmation" id="email_confirmation" value="{{ Request::old('email_confirmation') }}" type="text" class="span7 input-xlarge" placeholder="Confirm Email">
	                {{ ($errors->has('email_confirmation') ? $errors->first('email_confirmation') : '') }}
	            </div>
	        </div>

			<div class="control-group {{ $errors->has('password') ? 'error' : '' }}" for="password">
				<div class="controls">
					<input name="password" value="" type="password" class="span7 input-xlarge" placeholder="Password">
					{{ ($errors->has('password') ? $errors->first('password') : '') }}
			    </div>
			</div>

			<div class="control-group {{ $errors->has('password_confirmation') ? 'error' : '' }}" for="password_confirmation">
				<div class="controls">
					<input name="password_confirmation" value="" type="password" class="span7 input-xlarge" placeholder="Confirm Password">
					{{ ($errors->has('password_confirmation') ? $errors->first('password_confirmation') : '') }}
				</div>
			</div>

			<span class="help-block">
				By clicking the register button means you accept Nevermore's Privacy Policy, Terms and Conditions, and will uphold the rules both on the minecraft server and on the website.
			</span>

			<div class="form-actions">
				<input class="btn-primary btn" type="submit" value="Register">
				<input class="btn " type="reset" value="Reset">
			</div>
		</form>
	</div>
</div>
@stop

@section('javascript')
	@parent
	$('#dp').datepicker();
@stop