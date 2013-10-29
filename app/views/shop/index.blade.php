@extends('layouts.default')
@section('leftSide')
	@include('elements.shop-left')
@endsection
@section('rightSide')
	@include('elements.shop-right')
@endsection
@section('content')
	<div class="container well">
		@for($i = 1; $i < count($types); $i++)
			<div id="{{$types[$i]->name}}" class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">{{$types[$i]->name}}</h1>
				</div>
				<div class="panel-body">
					<div class="row">
						@foreach($items as $item)
							@if($item->type_id==($i+1))
								<div class="col-lg-3">
						   			<div class="thumbnail text-center">
						   				<h4>{{$item->name}}</h4>
						    			<img src="http://www.ledr.com/colours/white.jpg" class="img-rounded" height="100px" width="100px" alt="{{$item->name}}">
						    			<div class="caption">
									        <p>
									        	{{(!empty($item->plat)?'P: '.$item->plat:'')}} {{(!empty($item->silver)?'S: '.$item->silver:'')}}
									        </p>
									        <p>
									        	<a href="#" data-toggle="modal" data-target="#{{$item->id}}-buy" class="btn btn-primary btn-sm">Buy</a>
									        	&nbsp;
									        	<a href="#" data-toggle="modal" data-target="#{{$item->id}}-info" class="btn btn-default btn-sm">Info</a>
									        </p>
								    	</div>
								    </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		@endfor
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
			<div class="modal fade" id="{{$item->id}}-buy" tabindex="-1" role="dialog" aria-labelledby="{{$item->name}}Buy" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#999;">&times;</button>
			        <h4 class="modal-title">{{$item->name}} Buy</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="row">
			      		<div class="col-lg-offset-2 col-lg-3 well">
				        	@if(!empty($item->plat))
								P: {{$item->plat}}<br />
								Balance: {{ $user->getPlat()}}<br />
								{{ ($user->getPlat()-$item->plat) }}<br />
								@if(($user->getPlat()-$item->plat)>=0)
									<a href="#" class="btn btn-primary btn-small">Purchase</a>
								@else
									You don't have the funds.
								@endif
			        		@endif
			        	</div>
			        	<div class="col-lg-offset-1 col-lg-3 well">
				        	@if(!empty($item->silver))

				        	@endif
			        	</div>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
	@endforeach
@endsection
@section('javascript')
	$('.scroll').affix({
		offset: {
		  top: 40,
		  bottom: function () {
		    return (this.bottom = $('.bs-footer').outerHeight(true))
		  }
		}
	});
@endsection