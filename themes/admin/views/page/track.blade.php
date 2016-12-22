@extends('frontpage::layout.main')
@section('content')
<section class="sc-header">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<h3 class="sc-title text-xs-left">Track Your Order</h3>
				<p>Enter your lookup number (included in your confirmation email) to check the status of your order
				</p>
				<form class="form-inline">
				  <fieldset class="form-group">
				    <label for="order-number" class="sr-only">Order Number</label>
				    <input type="text" class="form-control" id="order-number" placeholder="Order Number">
				  </fieldset>
				  <button type="button" class="btn btn-info">Track Your Order</button>
				</form>
			</div>
			<div class="col-md-3 col-md-offset-2">
				<img class="img-fluid" src="{{ Theme::asset('images/track.png') }}">
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="order-head">
			<div class="row">
			<div class="col-md-1">
				<i class="fa fa-3x fa-paste"></i>
			</div>
			<div class="col-md-5">
				<div class="order-num">
						<span class="order-number">AL06.00001</span> - <span class="order-status">Waiting Payment</span>
				</div>
				<div class="order-meta">
					{{ date('Y M d, H:i:s') }}
				</div>
			</div>
			<div class="col-md-3 col-md-offset-3">
				<a class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Download Invoices</a>
			</div>
			</div>
		</div>	
	</div>
</section>
@stop