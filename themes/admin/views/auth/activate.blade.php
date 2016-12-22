@extends('frontpage::layout.main')
@section('content')
<section class="auth">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="auth-head text-xs-center">
					<h3>Activate</h3>
				</div>
				<div class="text-xs-center" id="loading">
					<i class="fa fa-spinner fa-4x fa-spin"></i>
					<p>Loading</p>
				</div>
				<p class="alert alert-success" style="display: none;">
					Your account has been activated, to continue please <a href="{{ url('/login') }}" class="btn btn-info">Sign In</a>
				</p>
			</div>
		</div>
	</div>
</section>
@stop

@section('js')
<script>
	$(document).ready(function() {
		var key = '{{ $code }}';
		$.ajax({
			url: app.host + 'activate?code=' + key,
			type: "GET",
			success: function(result) {
				$('#loading').fadeOut();
				if (result.meta.code === 200) {
					$('.alert')
						.removeClass('alert-danger')
						.removeClass('alert-success')
						.addClass('alert-success')
						.delay(500)
						.fadeIn();
				} else {
					var errorMsg = result.meta.message;
					if(result.meta.errors){
						errorMsg += app.handleError(result.meta.errors);	
					}
					
					$('.alert')
						.removeClass('alert-danger')
						.removeClass('alert-success')
						.addClass('alert-danger')
						.delay(500)
						.html(errorMsg).fadeIn();
				}
				$('#btnSubmit').removeAttr('disabled');
				$('#btnSubmit').html('Register');
			},
			error: function(result) {
				var errorMsg = '';
				$('#loading').fadeOut(500);
				if(result.responseJSON.meta){
					errorMsg += app.handleError('Your code ' + result.responseJSON.meta.message);	
				}
				
				$('.alert').delay(400)
					.removeClass('alert-danger')
					.removeClass('alert-success')
					.addClass('alert-danger')
					.fadeIn(500)
					.html(errorMsg);
			}
		});
	});
</script>
@stop