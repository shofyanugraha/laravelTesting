@extends('frontpage::layout.main')
@section('content')
<section class="sc-header">
	<div class="container">
		<h3 class="sc-title text-xs-left">Payment Confirmation</h3>
		<p>This confirmation process takes 1-2 workday.<br>Please check your email for updates status of your payment.
		</p>
	</div>
</section>
<section class="confirm">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form>
					<div class="card">
					<div class="card-block">
					<fieldset class="form-group">
					    <label for="invoice">Invoice Code</label>
					    <input type="text" class="form-control" id="invoice" placeholder="Enter your invoice code">
					  </fieldset>
					  <fieldset class="form-group">
					    <label for="invoice">Email</label>
					    <input type="email" class="form-control" id="email" placeholder="Enter your email address">
					  </fieldset>
					  <fieldset class="form-group">
					    <label for="invoice">Transfered to Account</label>
					    <select class="form-control">
					    	<option></option>
					    	<option>BCA</option>
					    	<option>BNI</option>
					    	<option>Mandiri</option>
					    	<option>BRI</option>
					    </select>
					  </fieldset>
					  <fieldset class="form-group">
					    <label for="invoice">Total Payment</label>
					    <input type="text" class="form-control" id="invoice" placeholder="Enter your total payment">
					  </fieldset>
					  <fieldset class="form-group">
					    <label for="invoice">Date</label>
					    <input type="date" class="form-control" id="invoice" placeholder="Enter your transfer date">
					  </fieldset>
					  <fieldset class="form-group">
					    <label for="invoice">Notes</label>
					    <textarea class="form-control"></textarea>
					  </fieldset>
					  <div class="clearfix">
					  <button class="btn btn-primary pull-xs-right">Confirm</button>
					  </div>
					  </div>
					  </div>
				</form>
			</div>
		</div>
	</div>
</section>
@stop