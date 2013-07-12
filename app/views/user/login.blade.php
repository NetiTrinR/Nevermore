@extends('layouts.default')

@section('content')
<div class="offset3 span5">
	<h3>Login</h3>
	<div class="well">
		<form action="{{ URL::to('users/login') }}" method="post">
	        {{ Form::token() }}

	        <div class="control-group {{ ($errors->has('email')) ? 'error' : '' }}" for="email">
	            <div class="controls">
	                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="input-xlarge" placeholder="E-mail"><br />
	                {{ ($errors->has('email') ? $errors->first('email') : '') }}
	            </div>
	        </div>
	    
	       <div class="control-group {{ $errors->has('password') ? 'error' : '' }}" for="password">
	            <div class="controls">
	                <input name="password" value="" type="password" class="input-xlarge" placeholder="Password"><br />
	                {{ ($errors->has('password') ? $errors->first('password') : '') }}
	            </div>
	        </div>

	        <div class="control-group" for"rememberme">
	            <div class="controls">
	                <label class="checkbox inline">
	                    <input type="checkbox" name="rememberMe" value="1"> Remember Me
	                </label>
	            </div>
	        </div>
	    
	        <div class="form-actions">
	            <input class="btn btn-primary" type="submit" value="Log In">
	            <a href="/users/resetpassword" class="btn btn-link">Forgot Password?</a>
	        </div>
	  </form>
	</div>
</div>
@endsection