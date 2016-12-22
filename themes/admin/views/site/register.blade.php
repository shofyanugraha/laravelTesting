<!DOCTYPE html>
<html>
<head>
    <title>{{$title or "GIMS Kota Tasikmalaya"}}</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,100,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,700' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/AdminLTE/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/AdminLTE/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('assets/AdminLTE/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('themes/'.\Theme::getActive()) }}/assets/css/style.css">
    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/summernote/dist/summernote.css')}}">
    @yield('css')
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    Talenesia
  </div>
  <!-- /.login-logo -->
  @include('flash::message')
  <div class="login-box-body">
  	
    <form class="form" method="post" action="{{url('/register')}}">
      <input name="_token" value="{{ csrf_token() }}" type="hidden">
      <div class="form-group has-feedback">
      	{!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      	{!! Form::select('role', ['admin' => 'Admin', 'manager' => 'Manager'], null,  ['class'=>'form-control']); !!}
        
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
    @yield('body')

    
    <script src="{{asset('assets/holderjs/holder.min.js')}}"></script>

     <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/AdminLTE/plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/AdminLTE/dist/js/app.min.js')}}"></script>
    
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/AdminLTE/dist/js/demo.js')}}"></script>
    
    <script src="{{asset('assets/summernote/dist/summernote.min.js')}}"></script>
    @yield('js')

   

</body>
</html>