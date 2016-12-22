@extends('admin::layout.main')
@section('content')
<section class="auth">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="auth-head text-xs-center">
					<h3>Sign In</h3>
				</div>
				<p class="alert" style="display: none;"></p>
				<form method="post" id="form-login">
					<div class="card">
					<div class="card-block">
					<fieldset class="form-group">
					    <label class="sr-only" for="invoice">Email</label>
					    <input type="email" class="form-control" id="email" placeholder="Email">
					  </fieldset>
					  <fieldset class="form-group">
					    <label class="sr-only" for="invoice">Password</label>
					    <input type="password" class="form-control" id="password" placeholder="Password">
					  </fieldset>
					  
					  <div class="clearfix">
					  	<a href="{{ url('forget') }}">Forgot Password?</a>
					  	<button class="btn btn-primary pull-xs-right" id="btn-submit">Sign In</button>
					  </div>
					  </div>
					  </div>
				</form>
				<p class="text-xs-center">Doen't have an account? <a href="{{ url('/register') }}">Sign Up</a></p>
				<!-- <div class="section-divider">Or Sign In With</div>
				<div class="row">
					<div class="col-md-6">
						<a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
					</div>
					<div class="col-md-6">
						<a href="#" class="btn btn-facebook"><i class="fa fa-google-plus"></i> Google</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</section>
@stop

@section('js')
<script>
$(document).load(function() {
	var storage = $.sessionStorage;
	console.log(storage.get('user'));
});	
$(document).ready(function() {
	var storage = $.sessionStorage;
	console.log(storage.get('user'));
	$('#form-login').validator().on('submit', function (e) {
	  if (e.isDefaultPrevented()) {
	    // handle the invalid form...
	  } else {
	  	e.preventDefault();
	    var fd = new FormData();
		
		fd.append('email', $('#email').val());
		fd.append('password', $('#password').val());
		// fd.append('password', );
		
		$('#btn-submit').attr('disabled','disabled');
		$('#btn-submit').prepend('<i class="fa fa-spinner fa-spin"></i> ');

		$.ajax({
			url: app.host + 'login',
			type: "POST",
			processData: false,
  			contentType: false,
  			data: fd,
			success: function(result) {
				if (result.meta.code === 200) {
					$.ajax({
							url: '{{ url("/session") }}',
							type: "POST",
							headers: {
						        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
				  			data: result.data,
							success: function(result) {
								result = JSON.parse(result);
								
								var url = '/dashboard';
								// console.log(result.roles[0]);

								var url = '/dashboard';
								var storage = $.localStorage;

								storage.set('user', result.data);
								window.location = url;
							},
							error: function(data) {
								$('.alert')
									.removeClass('alert-danger')
									.removeClass('alert-success')
									.addClass('alert-danger')
									.slideDown()
									.html('Error, can not save a session');
							}
						});
					
				} else {
					var errorMsg = '';
					if(result.error){
						errorMsg += app.handleError(result.meta.errors);	
					}
					
					$('.alert')
						.removeClass('alert-danger')
						.removeClass('alert-success')
						.addClass('alert-danger')
						.slideDown()
						.html(errorMsg);
					$('#btn-submit').removeAttr('disabled');
					$('#btn-submit').html('Login');
				}
			},
			error: function(result) {
				// console.log(result);
				$('#btn-submit').removeAttr('disabled');
				$('#btn-submit').html('Sign In');
				var errorMsg = '';
				
				
				errorMsg += app.handleError(result.responseJSON.meta.message);	
				

				if(result.responseJSON.meta.errors){
					errorMsg += 'Your input does not valid :';
					errorMsg += app.handleError(result.responseJSON.meta.errors);	
				}
				
				$('.alert')
					.removeClass('alert-danger')
					.removeClass('alert-success')
					.addClass('alert-danger')
					.slideDown()
					.html(errorMsg);
			}
		});
	  }
	});
});
</script>
@stop