@extends('admin::layout.main')
@section('content')
<div class="slider text-center">
	<div id="layerslider" style="width: 1280px; height: 720px; max-width: 1280px;">

			<!-- slide one start -->

			<div class="ls-slide" data-ls="slidedelay: 7000; transition2d: 75,79;">

				<!-- slide background image -->

				<img src="sliderimages/jellyfish-blur.jpg" class="ls-bg" alt="Slide background"/>

				<!-- layer one -->

				<h1 class="ls-l" style="top: 100px; left: 100px;" data-ls="
					offsetxin: 0;
					offsetxout: 300;
					offsetyin: top;
					offsetyout: 300;
					durationin: 2000;
					durationout: 2000;
					delayin: 2000;
					rotateyin: 60;
				">It's a clownfish!</h1>

				<!-- layer two -->

				<img class="ls-l" style="left: 30%; top: 50%;" src="sliderimages/clownfish.png" alt="Image layer" data-ls="
					offsetxin: left;
					offsetxout: right;
					offsetyin: 150;
					offsetyout: -250;
					fadein: false;
					fadeout: false;
					easingin: easeoutquart;
					easingout: easeinquart;
					durationin: 2500;
					durationout: 2500;
					delayin: 500;
					showuntil: 1;
				">

			</div>

			<!-- slide one end -->

			<!-- slide two start -->

			<div class="ls-slide" data-ls="slidedelay: 5000; transition2d: 5; timeshift: -1000;">

				<!-- slide background image -->

				<img src="sliderimages/slide-b-bg.jpg" class="ls-bg" alt="Slide background"/>

				<!-- layer one -->

				<h2 class="ls-l" style="top: 600px; left: 50%;" data-ls="
					offsetxin: -100;
					offsetxout: 0;
					offsetyin: 0;
					offsetyout: bottom;
					durationin: 2500;
					delayin: 1000;
					skewxin: 60;
				">We like Tucans :)</h2>

				<!-- layer two -->

				<img class="ls-l" style="left: 650px; top: 70px;" src="sliderimages/tucan.png" alt="Image layer" data-ls="
					offsetxin: right;
					offsetxout: 0;
					offsetyin: 200;
					offsetyout: bottom;
					rotatein: 50;
					rotateout: -20;
					fadein: false;
					fadeout: false;
					easingin: easeoutquart;
					easingout: easeinquart;
					durationin: 2500;
					delayin: 500;
				">

			</div>

			<!-- slide two end -->

		</div>
</div>

<section class="campaign">
	<div class="container">
		<h4 class="sc-title">Featured Campaign</h4>
		<div class="row">
		@for($i=1; $i <= 4; $i++)
			<div class="col-md-3">
				<div class="campaign-item">
					<img src="{{Theme::asset('frontpage::images/campaign-'. $i . '.jpg')}}" class="img-fluid campaign-image">
					<h6>Campaign {{$i}}</h6>
					<div class="timeline">
						<i class="fa fa-clock-o"></i> 2 days left
					</div>
				</div>
			</div>
		@endfor
		@for($i=1; $i <= 4; $i++)
			<div class="col-md-3">
				<div class="campaign-item">
					<img src="{{Theme::asset('frontpage::images/campaign-'. $i . '.jpg')}}" class="img-fluid">
					<h6>Campaign {{$i}}</h6>
					<div class="timeline">
						<i class="fa fa-clock-o"></i> 2 days left
					</div>
				</div>
			</div>
		@endfor
		</div>
	</div>
</section>
<section class="about">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="video-holder">
					<a href="https://www.youtube.com/watch?v=WeA9GNMG6M8" class="play-video" target="_blank">
						<span></span>
						<img src="{{Theme::asset('frontpage::images/video.jpg')}}" class="img-fluid">
					</a>
				</div>
			</div>
			<div class="col-md-6 about-holder">
				<h4>Discover Blazbluz: The free and easy way to bring your ideas to life.</h4>
				<p>Design your shirt, set a price, add a goal and start selling. Blazbluz handles the rest - production, shipping, and customer service - and you keep the profit!</p>
				<a class="btn btn-primary" href="">Learn More</a>
			</div>
		</div>
	</div>
</section>
<section class="started">
	<div class="container text-xs-center">
		<h3 class="sc-title sc-inline">Ready to launch your own campaign? </h3>
		<a class="btn btn-lg btn-warning" id="btn-started" href="#">Get Started</a>
	</div>
</section>
<section class="testimonial">
	<div class="container">
		<h3 class="sc-title">What Do People Say?</h3>
		<div class="owl-carousel">
		  <div class="testi-item">
		  	<div class="row">
		  		<div class="col-xs-2">
		  			<img src="{{ Theme::asset('frontpage::images/client-1.png') }}" class="img-fluid">
		  		</div>
		  		<div class="col-xs-10">
		  			<div class="card card-block">
		  				<h3 class="card-title">Nishant Bhardwaj</h3>
		  				<p class="card-text">Fusce vehicula dolor arcu, sit amet blandit dolor mollis nec. Donec viverra eleifend lacus, vitae ullamcorper metus. </p>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		  <div class="testi-item">
		  	<div class="row">
		  		<div class="col-xs-2">
		  			<img src="{{ Theme::asset('frontpage::images/client-2.png') }}" class="img-fluid">
		  		</div>
		  		<div class="col-xs-10">
		  			<div class="card card-block">
		  				<h3 class="card-title">Nishant Bhardwaj</h3>
		  				<p class="card-text">Fusce vehicula dolor arcu, sit amet blandit dolor mollis nec. Donec viverra eleifend lacus, vitae ullamcorper metus. </p>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		  <div class="testi-item">
		  	<div class="row">
		  		<div class="col-xs-2">
		  			<img src="{{ Theme::asset('frontpage::images/client-1.png') }}" class="img-fluid">
		  		</div>
		  		<div class="col-xs-10">
		  			<div class="card card-block">
		  				<h3 class="card-title">Nishant Bhardwaj</h3>
		  				<p class="card-text">Fusce vehicula dolor arcu, sit amet blandit dolor mollis nec. Donec viverra eleifend lacus, vitae ullamcorper metus. </p>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		  <div class="testi-item">
		  	<div class="row">
		  		<div class="col-xs-2">
		  			<img src="{{ Theme::asset('frontpage::images/client-2.png') }}" class="img-fluid">
		  		</div>
		  		<div class="col-xs-10">
		  			<div class="card card-block">
		  				<h3 class="card-title">Nishant Bhardwaj</h3>
		  				<p class="card-text">Fusce vehicula dolor arcu, sit amet blandit dolor mollis nec. Donec viverra eleifend lacus, vitae ullamcorper metus. </p>
		  			</div>
		  		</div>
		  	</div>
		  </div>
		</div>		
	</div>
</section>
@stop