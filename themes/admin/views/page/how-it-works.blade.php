@extends('frontpage::layout.main')
@section('content')
<section class="sc-header">
	<div class="container">
		<h3 class="sc-title text-xs-left">How It Works</h3>
		<p>Blazbluz  gives you the tools and support you to sell custom T-Shirts online.<br>It's for free and risk free. Share your campaign around you and collect your sales profits!
		</p>
	</div>
</section>
<section class="how-design first">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-4 text-xs-center">
				<img class="wow fadeInLeftBig img-fluid" src="{{Theme::asset('frontpage::images/design.png')}}">
			</div>
			<div class="col-md-2 text-xs-center">
				<div class="wow fadeInUp action-number">1</div>
			</div>
			<div class="col-md-4 wow fadeInRightBig">
				<h4>Create your design</h4>
				<p>Choose a product and create your design with the BluzDesigner, our customisation tool. You can upload a file/picture, or create your visual identity thanks to Teezily's multiple functionalities. </p>
			</div>
		</div>
	</div>
</section>
<section class="how-design">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-4 text-xs-center">
				<img class="wow fadeInLeftBig img-fluid" src="{{Theme::asset('frontpage::images/campaign.png')}}">
			</div>
			<div class="col-md-2 text-xs-center">
				<div class="wow fadeInUp action-number">2</div>
			</div>
			<div class="col-md-4 wow fadeInRightBig">
				<h4>Launch campaign</h4>
				<p>Set your sales goal, the price of the product and your profits on every sale. Name your campaign and write a message for your community. </p>
			</div>
		</div>
	</div>
</section>
<section class="how-design">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-4 text-xs-center">
				<img class="wow fadeInLeftBig img-fluid" src="{{Theme::asset('frontpage::images/share.png')}}">
			</div>
			<div class="col-md-2 text-xs-center">
				<div class="wow fadeInUp action-number">3</div>
			</div>
			<div class="col-md-4 wow fadeInRightBig">
				<h4>Share to Social Media</h4>
				<p>Creates for you a unique URL link that allows you to spread your campaign via social networks and e-mail. Share your creation around you and follow our tips to reach your goal and maximise the orders.</p>
			</div>
		</div>
	</div>
</section>
<section class="how-design">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-4 text-xs-center">
				<img class="wow fadeInLeftBig img-fluid" src="{{Theme::asset('frontpage::images/solve.png')}}">
			</div>
			<div class="col-md-2 text-xs-center">
				<div class="wow fadeInUp action-number">4</div>
			</div>
			<div class="col-md-4 wow fadeInRightBig">
				<h4>Blazbluz take care of everything!</h4>
				<p>Once you have reached your sales goal, Blazbluz takes care of the rest. The products are printed in Bandung and sent to each of your buyers within 3-5 working days.</p>
			</div>
		</div>
	</div>
</section>
<section class="how-design last">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-4 text-xs-center">
				<img class="wow fadeInLeftBig img-fluid" src="{{Theme::asset('frontpage::images/money.png')}}">
			</div>
			<div class="col-md-2 text-xs-center">
				<div class="wow fadeInUp action-number">5</div>
			</div>
			<div class="col-md-4 wow fadeInRightBig">
				<h4>Cash in your profits</h4>
				<p>All the profits earned will go to you. If you have decided to raise money for a third party, Blazbluz will directly redistribute the money to the end beneficiary you have chosen within 5 working days.</p>
			</div>
		</div>
	</div>
</section>

@stop