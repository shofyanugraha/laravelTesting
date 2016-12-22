<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">        
        @yield('meta')
        <title>{{ $title or 'Blazbluz' }}</title>
        
        <!-- core CSS -->
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,900' rel='stylesheet' type='text/css'>       
        <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ Theme::asset('frontpage::css/app.css') }}" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('css')
    </head>

    <body class="{{ $body or 'application' }}">
        <nav class="navbar navbar-light bg-faded">
            <div class="container">
              <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
                &#9776;
              </button>
              <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ Theme::asset('images/logo.png') }}"></a>
              </div>
            </div>
        </nav>
        
        
        @yield('content')

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="widget widget-about">
                            <img src="{{Theme::asset('frontpage::images/logo.png')}}" width="180" class="img-fluid">
                            <p>
                                <span class="icon"><i class="fa fa-calendar-minus-o"></i></span> Monday - Saturday<br>
                                <span class="icon"><i class="fa fa-clock-o"></i></span> 09.00 - 21.00<br>
                                <span class="icon"><i class="fa fa-phone"></i></span> <a href="tel:+62812131231">+62812131231</a><br>
                                <span class="icon"><i class="fa fa-envelope-o"></i></span> <a href="mailto:helo@blazbluz.com">helo@blazbluz.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="widget">
                            <h5 class="widget-title">Help</h5>
                            <ul class="nav widget-nav">
                                <li><a href="{{ url('/track-order') }}">Track Order</a></li>
                                <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                                <li><a href="{{ url('/faq') }}">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="widget">
                            <h5 class="widget-title">About</h5>
                            <ul class="nav widget-nav">
                                <li><a href="{{ url('/about-us') }}">About Blazbluz</a></li>
                                <li><a href="{{ url('/blog') }}">Press</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="widget form-widget">
                            <h5 class="widget-title">Subscribe Newsletter</h5>
                        <form class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2" class="sr-only">Email</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Your Email">
                                    <button type="submit" class="btn btn-primary">Subscribe</button>
                                </div>
                            </form>
                            <ul class="nav nav-inline nav-social">
                                <li class="nav-item"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li class="nav-item"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li class="nav-item"><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="copyright">
            <p>All Content Copyright &copy; 2016 Blazbluz.</p>
        </div>
        <script src="{{ Theme::asset('frontpage::js/app.js') }}"></script>
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
        @yield('js')
    </body>
</html>