@extends('frontpage::layout.main')
@section('content')
<section class="auth">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="auth-head text-xs-center">
					<h3>Sign Up</h3>
				</div>
				<p class="alert text-xs-left" style="display: none;"></p>
				<form id="form-register">
					<div class="card">
						<div class="card-block">
							<fieldset class="form-group">
								<label class="sr-only" for="fullname">Full Name</label>
								<input type="text" required="required" class="form-control" id="fullname" placeholder="Full Name">
								<div class="help-block with-errors"></div>
							</fieldset>
							<fieldset class="form-group">
								<label class="sr-only" for="username">Unique URL</label>
								<input type="text" required="required"  class="form-control" id="username" placeholder="Unique URL" data-remote="/username" data-error="Unique URL has been taken">
								<div class="help-block with-errors"></div>
								<div class="preview-url">http://blazbluz.com/<span id="unique-URL">unique-url</span>/campaign-name</div>
								
							</fieldset>

							<fieldset class="form-group">
								<label class="sr-only" for="invoice">Email</label>
								<input type="email" class="form-control" required="required" id="email" placeholder="Email">
								<div class="help-block with-errors"></div>
							</fieldset>
							<fieldset class="form-group">
								<label  class="sr-only" for="invoice">Password</label>
								<input type="password" class="form-control" required="required" id="password" placeholder="Password">
								<div class="help-block with-errors"></div>
							</fieldset>
							<fieldset class="form-group">
								<label  class="sr-only" for="invoice">Confirm Password</label>
								<input type="password" data-match="#password" class="form-control" required="required" id="re-password" placeholder="Confirm Password" data-error="Password missmatch">
								<div class="help-block with-errors"></div>
							</fieldset>
							<div class="clearfix text-xs-left">
								Have an account? <a href="{{ url('/login') }}">Sign In</a>
								<button class="btn btn-primary pull-right" id="btn-submit">Sign Up</button>
							</div>
						</div>
					</div>
				</form>
				<!-- 
				<div class="section-divider">Or Sign Up With</div>
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
	$(document).ready(function() {

		$('#fullname').keyup(function(e) {
			var fullname = $('#fullname').val();
			if(fullname.length > 10) {
				fullname = fullname.split(' ').join('-').toLowerCase().substr(0, 15);
			} else {
				fullname = fullname.split(' ').join('-').toLowerCase();
			} 
			$('#username').val(fullname);
			$('#unique-URL').html(fullname);
		});

		$('#username').keyup(function() {
			var username = $(this).val();
			username = username.split(' ').join('-').toLowerCase().substr(0, 15);
			$('#username').val(username);
			if ($('#username').val() === '') {
				$('#unique-URL').html('unique-url');	
			} else {
				$('#unique-URL').html($('#username').val());	
			}
		});
		

		$('#form-register').validator().on('submit', function (e) {
		  if (e.isDefaultPrevented()) {
		    // handle the invalid form...
		  } else {
		  	e.preventDefault();
		    var fd = new FormData();
			
			fd.append('email', $('#email').val());
			fd.append('name', $('#fullname').val());
			fd.append('username', $('#username').val());
			fd.append('password', $('#password').val());
			fd.append('password_confirmation', $('#re-password').val());
			// fd.append('password', );
			
			$('#btn-submit').attr('disabled','disabled');
			$('#btn-submit').prepend('<i class="fa fa-spinner fa-spin"></i> ');

			$.ajax({
				url: app.host + 'register',
				type: "POST",
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				processData: false,
	  			contentType: false,
	  			data: fd,
				success: function(result) {
					if (result.meta.code === 200) {
						$('#btn-submit').removeAttr('disabled');
						$('#btn-submit').html('Register');
						
						$('#form-register').fadeOut();
						var msg = '<p>Thank you for register at Blazbluz, ';
			            msg += 'please check your email to verify your account';
			            msg += '</p>';
						$('.alert')
							.removeClass('alert-danger')
							.removeClass('alert-success')
							.addClass('alert-success')
							.delay(500).fadeIn()
							.html(msg);
					} else {
						var errorMsg = '';
						if(result.error){
							errorMsg += app.handleError(result.error);	
						}
						
						$('.alert')
							.removeClass('alert-danger')
							.removeClass('alert-success')
							.addClass('alert-danger')
							.slideDown()
							.html(errorMsg);
					}
					$('#btn-submit').removeAttr('disabled');
					$('#btn-submit').html('Register');
				},
				error: function(result) {
					// console.log(result);
					$('#btn-submit').removeAttr('disabled');
					$('#btn-submit').html('Register');
					var errorMsg = '';
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