@extends('layouts.default')
@section('content')
<div class="page-header"><h1>403 Access Denined <br/><small class="tabbed">You probably didn't want to go there anyways.</small></h1></div>
<div class="container well">
	<p>You have just been denined access to a page and have been redirected here. Follow the footer Navigation links or return to the <a href="{{URL::Route('home')}}">home page</a>. If you feel like you have reached this page in error, double check the url. If problems persist contact Rails via <a href="mailto:netitrinr@gmail.com" class="text-warning">email</a> or in game.</p>
</div>
@endsection