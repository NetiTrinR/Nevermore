@extends('layouts.default')
@section('leftSide')
	@include('elements.shop-left')
@endsection
@section('rightSide')
	@include('elements.shop-right')
@endsection
@section('content')
	<div class="page-header"><h1>Nevermore Shop <small>Where you buy stuff</small></h1></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Cash</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				@foreach($items as $item)
					<div class="col-lg-3">
			   			<div class="thumbnail text-center">
			   				<h4>{{$item->name}}</h4>
			    			<img src="http://www.ledr.com/colours/white.jpg" class="img-rounded" height="100px" width="100px" alt="{{$item->name}}">
			    			<div class="caption">
						        <p>
						        	{{(!empty($item->plat)?'P: '.$item->plat:'')}} {{(!empty($item->silver)?'S: '.$item->silver:'')}}
						        </p>
						        <p>
						        	<a href="#" class="btn btn-primary btn-sm">Buy</a>
						        	&nbsp;
						        	<a href="#" data-toggle="modal" data-target="#{{$item->id}}-info" class="btn btn-default btn-sm">Info</a>
						        </p>
					    	</div>
					    </div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
@section('modal')
	@foreach($items as $item)
		<div class="modal fade" id="{{$item->id}}-info" tabindex="-{{$item->id}}" role="dialog" aria-labelledby="{{$item->name}}Info" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#999;">&times;</button>
		        <h4 class="modal-title">{{$item->name}} Info</h4>
		      </div>
		      <div class="modal-body">
		        <p>{{$item->desc}}</p>
		      </div>
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-primary" data-dismiss="modal">Purchase</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	@endforeach
@endsection
					
				