@extends('layouts.default')

@section('content')
	{{$userData->username}}'s Settings
	
		<ul id="userTabs" class="nav nav-tabs">
				<li class="active"><a href="#profile" class="tab1" data-toggle="tab">Profile</a></li>
				<li><a href="#account" class="tab2" data-toggle="tab">Account</a></li>
				<li><a href="{{ URL::to('/shop/purchases') }}">Purchases</a></li>
			</ul>
			<div class="tab-content well">
				<div class="tab-pane active" id="profile">
					1
				</div>
				<div class="tab-pane" id="account">
					2
				</div>
			</div>
@endsection