@extends('layouts.default')

@section('content')
<div class="col-lg-offset-3 col-lg-5">
	<h3>Login</h3>
	<div class="well">
		<form action="{{ URL::to('user/login') }}" method="post">
	        {{ Form::token() }}

	        <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <input name="email" id="email" value="{{ Request::old('email') }}" type="text" class="form-control" placeholder="E-mail">
                <span class="help-block">{{ ($errors->has('email') ? $errors->first('email') : '') }}</span>
	        </div>
	        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input name="password" value="" type="password" class="form-control" placeholder="Password">
                <span class="help-block">{{ ($errors->has('password') ? $errors->first('password') : '') }}</span>
	        </div>
	        <div class="checkbox">
	                <label>
	                    <input type="checkbox" name="rememberMe" value="1"> Remember Me
	                </label>
	        </div>

	        
        	<div class="row">
        		<div class="col-lg-4">
        			<div class="form-actions">
        				<input class="btn btn-primary" type="submit" value="Log In">
        			</div>
        			</div>
        		<div class="col-lg-8">
        			<a href="{{ URL::to('user/register') }}">Need an Account?</a><br />
           			<a href="{{ URL::to('user/resetpassword') }}">Forgot Password?</a>
           		</div>
        	</div>
	  </form>
	</div>
</div>
@endsection