<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @yield('meta')
        <title>{{ $title or 'Blazbluz' }}</title>
        
        <!-- core CSS -->
        <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,900' rel='stylesheet' type='text/css'>       
        <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/Ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ Theme::asset('admin::css/app.css') }}" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('css')
    </head>

    <body class="{{ $body or 'application' }} hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('/dashboard') }}" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini">BB</span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg">blazbluz</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Tasks: style can be found in dropdown.less -->
                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      @if (Sentinel::check())
                      <span class="hidden-xs">{{ Sentinel::getUser()->email }}</span>
                      @endif
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                          <li>
                            <a href="{{ url('/setting') }}">
                              <i class="icon ion-ios-gear-outline"></i> Setting
                            </a>
                          </li>
                          <li>
                            <a href="{{ url('/logout') }}">
                              <i class="icon ion-log-out"></i> Logout
                            </a>
                          </li>
                        </ul>
                        </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
        </header>
          <!-- =============================================== -->

          <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->

            <section class="sidebar">
              <!-- sidebar menu: : style can be found in sidebar.less -->
              
              <ul class="sidebar-menu">
                <li><a href="{{ url('/bank') }}"><i class="ion-ios-home-outline"></i> <span>Bank</span></a></li>
                <li><a href="{{ url('/color') }}"><i class="ion-tshirt-outline"></i> <span>Color</span></a></li>
                <li><a href="{{ url('/style') }}"><i class="ion-ios-pricetags-outline"></i> <span>Style</span></a></li>
                <li><a href="{{ url('/user') }}"><i class="ion-ios-person-outline"></i> <span>Administration</span></a></li>
                <li><a href="{{ url('/design') }}"><i class="ion-ios-person-outline"></i> <span>Design</span></a></li>
                <li><a href="{{ url('/confirmation') }}"><i class="ion-ios-person-outline"></i> <span>Konfirmasi</span></a></li>
                <li><a href="{{ url('/campaign') }}"><i class="ion-ios-person-outline"></i> <span>Campaign</span></a></li>
                <li><a href="{{ url('/campaign/image') }}"><i class="ion-ios-person-outline"></i> <span>Image</span></a></li>
                <li><a href="{{ url('/order') }}"><i class="ion-ios-person-outline"></i> <span>Order</span></a></li>
                <li><a href="{{ url('/affiliate') }}"><i class="ion-ios-person-outline"></i> <span>Affiliate</span></a></li>
                <li><a href="{{ url('/production') }}"><i class="ion-ios-person-outline"></i> <span>Production</span></a></li>
                <li><a href="{{ url('/warehouse') }}"><i class="ion-ios-person-outline"></i> <span>Warehouse</span></a></li>
                <li><a href="{{ url('/payout') }}"><i class="">Rp</i> <span>Payout</span></a></li>
                <li><a href="{{ url('/production/warehouse') }}"><i class="ion-ios-person-outline"></i> <span>Gudang V2</span></a></li>
                <li><a href="{{ url('/production/production-v2') }}"><i class="ion-ios-person-outline"></i> <span>Production V2</span></a></
                <li><a href="{{ url('/production/shipping') }}"><i class="ion-ios-person-outline"></i> <span>Shipping V2</span></a></li>
              </ul>

            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
        </div>
        
        <div class="control-sidebar-bg"></div>
    </div>
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
        <div class="overlay" style="display:none;">
          <div class="text-xs-center" id="loading">
            <i class="fa fa-spinner fa-4x fa-spin"></i>
          </div>
        </div>
        @yield('js')
    </body>
</html>