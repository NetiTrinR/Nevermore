<div class="container scroll">
	<div class="row">
		<div class="panel panel-warning">
			<div class="panel-body">
				<center><a href="{{URL::Route('cash')}}" class="block btn btn-warning">Purchase Money</a></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">My Balances</h1>
			</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li>
						Platinum: {{$user->getPlat()}}
					</li>
					<li>
						Silver: {{$user->getSilver()}}
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">My Subscriptions</h1>
			</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li><b>VIP II</b>: <abbr title="Expires {{ date('m-d-Y') }}">{{ date('d') }}</abbr></li>
				</ul>
				<a href="#">Edit</a>
			</div>
		</div>
	</div>
</div>