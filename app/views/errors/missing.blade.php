@extends('layouts.default')
@section('content')
<div class="page-header"><h1>404 Page not Found <br/><small class="tabbed">I think we took a wrong turn somewhere...</small></h1></div>
<div class="container well">
	<p>You just tried to load a non-existential page and have been redirected here. Follow the footer Navigation links or return to the <a href="{{URL::Route('home')}}">home page</a>. If you feel like you have reached this page in error, double check the url. If problems persist contact <a href="{{URL::to('/user/rails/profile')}}">Rails</a> via <a href="mailto:netitrinr@gmail.com" class="text-warning">email</a> or in game.</p>
</div>
@endsection