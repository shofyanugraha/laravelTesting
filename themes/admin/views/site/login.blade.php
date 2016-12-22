<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <title>{{ $title or 'nixin' }}</title>
        
        <!-- core CSS -->
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,900' rel='stylesheet' type='text/css'>       
        <link href="{{ Theme::asset('admin::css/app.css') }}" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
<body class="hold-transition login-page skin-blue-light">

<div class="login-box">
  <div class="login-logo">
    Login
  </div>
  <div class="alert"></div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form class="form" method="post" id="formLogin">
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="Email" required="required" autofocus="autofocus" id="email">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      	<input type="password" name="password" class="form-control" required="required" placeholder="Password" id="password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

 <script src="{{ Theme::asset('admin::js/app.js') }}"></script>
        <script type="text/javascript">
            //disable ajax cache it solves that the Ajax content doesn't load properly when back button is clicked
            $.ajaxSetup({ cache: false });
            //force reload page on back browser button
            window.onpopstate = function(event) {
                if(event && event.state) {
                    location.reload()
                }
            }
        </script>
        <script type="text/javascript">
          $(document).ready(function() {

            $('#formLogin').parsley();

            $('#formLogin').submit(function(e) { 
                e.preventDefault();
                if ( $(this).parsley().isValid() ) {
                  var fd = new FormData();
                  fd.append('login', $('#email').val());
                  fd.append('password', $('#password').val());
                  $('.overlay').fadeIn();
                  $.ajax({
                    url: app.host + 'login',
                    type: "POST",
                    processData: false,
                      contentType: false,
                      data: fd,
                    success: function(result) {
                      if (result.meta.code === 200) {
                        $.ajax({
                          url: '{{ url("/auth/session") }}',
                          type: "POST",
                          headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                          data: result.data,
                          success: function(result) {
                            result = JSON.parse(result);
                            console.log(result);
                            if(result.status === true) {
                              window.location = '/dashboard';
                            }
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
                        $('.overlay').fadeOut();
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
                      $('#btn-submit').html('Simpan');
                    },
                    error: function(result) {
                      if (result.status === 422) {
                        $('.overlay').fadeOut();
                        var errorMsg = '';
                        if(result.responseJSON.meta.message){
                          errorMsg += app.handleError(result.responseJSON.meta.errors); 
                        }
                      } else if (result.status === 500) {
                        $('.overlay').fadeOut();
                        var errorMsg = 'You got an error for accessing this website, tell the admin about this error';
                        $('.alert')
                          .removeClass('alert-danger')
                          .removeClass('alert-success')
                          .addClass('alert-danger')
                          .slideDown()
                          .html(errorMsg);
                      }
                    }
                  });
                }
            });
          });
        </script>
    </body>
</html>