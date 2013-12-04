@extends('layouts.default')

@section('content')
	<ul id="userTabs" class="nav nav-tabs">
			<li class="active"><a href="#profile" class="tab1" data-toggle="tab">Profile</a></li>
			<li><a href="#account" class="tab2" data-toggle="tab">Account</a></li>
			<li><a href="{{ URL::to('/shop/purchases') }}">Purchases</a></li>
		</ul>
		<div class="tab-content well">
			<div class="tab-pane active" id="profile">
				<center><h3>Additional Profile Options</h3></center>
				<form action="" role="form">
					<div class="row">
						<div class="col-lg-6">
							<h4>Additional Information</h4>
							<div class="form-group">
								<label for="location">Location</label>
								<input type="text" class="form-control" id="input_location"><br />
								<span class="help-block"></span>
							</div>
						</div>
						<div class="col-lg-3"></div>
						<div class="col-lg-3">
							<h4>Display Settings</h4>
							<label>Show Date of Birth</label><br />
							<div class="make-switch tabbed">
								<input type="checkbox" id="show_dob" data-on="success" data-off="danger" checked>
							</div><br />
							<label>Show Location</label><br />
							<div class="make-switch tabbed">
								<input type="checkbox" id="show_location" data-on="success" data-off="danger" checked>
							</div><br />
							<label>Show Microblog</label><br />
							<div class="make-switch tabbed">
								<input type="checkbox" id="show_micro" data-on="success" data-off="danger" checked>
							</div><br />
							<label>Allow Posting</label><br />
							<div class="make-switch tabbed">
								<input type="checkbox" id="show_post" data-on="success" data-off="danger" checked>
							</div>
						</div>
					</div>
					<hr />
					<button type="submit" class="btn btn-primary">Save</button>
				</form>
				
			</div>
			<div class="tab-pane" id="account">
				<div class="row">
					<div class="col-lg-6">
						<h3>Login Information</h3>
						<form action="" role="form">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" class="form-control">
								<span class="help-block"></span>
							</div>
							<hr />
							<button type="submit" class="btn btn-primary">Save</button>
						</form>
					</div>
					<div class="col-lg-6">
						<h3>Account Details</h3>
						<p id="account_help_block">You can edit your <b>name</b>, <b>date of birth</b>, <b>website username</b>, and <b>IGN</b> here however these changes are not immediate and must be reviewed by an administrator.  This information is required and must remain accurate at all times as stated in terms and conditions. A reason must be provided for these changes. An administrator may contact to for further information regarding the changes. <u>You may also delete your account here.</u><br /><br />
						<button type="button" class="btn btn-warning pull-right" id="edit">Edit</button>
						</p>
						<form id="account_form"action="" role="form">
							<div class="form-group">
								<label>First Name</label>
								<input name="new_first" type="text" class="form-control" id="input_first">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Last Name</label>
								<input name="new_last" type="text" class="form-control" id="input_last">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Date of Birth</label>
								<input name="new_dob" type="text" class="form-control" id="input_dob">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input name="new_User" type="text" class="form-control" id="input_username">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Minecraft IGN</label>
								<input name="IGN" type="text" class="form-control" id="input_minecraft">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label>Reason</label>
								<textarea name="reason" id="reason" class="form-control" data-provide="markdown"></textarea>
							</div>
							<hr />
							<button type="submit" class="btn btn-default">Submit</button>
							<button type="button" data-toggle="modal" data-target="#delete_confirm" class="btn btn-danger" id="delete">Delete Account</button>	
						</form>
					</div>
				</div>
			</div>
		</div>
@endsection
@section('modal')
	<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="delete_confirm_lable" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#999;">&times;</button>
	        <h4 class="modal-title">Are you sure?</h4>
	      </div>
	      <div class="modal-body">
	      	Are you sure you want to delete your account? Doing so will remove all visable content concerning your account.
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-danger" data-dismiss="modal">Yes, I want to delete my account.</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endsection
@section('javascript')
	$('#account_form').hide();
	$('#edit').on('click', function(){
		$('#account_form').show();
		$('#account_help_block').hide();
	});
@endsection