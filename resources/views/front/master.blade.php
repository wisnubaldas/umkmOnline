<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} - @yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @stack('style')
</head>
<body class="hold-transition skin-purple layout-top-nav fixed">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="{{ url('/') }}" class="navbar-brand">{{ config('app.name') }}</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          @if(Auth::check())
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="{{ \Request::segment(1) == 'payment' || \Request::segment(1) == 'buy' ? 'active' : '' }}">
                <a href="{{ url('payment') }}">
                  Pembelian
                </a>
              </li>
              @if(Auth::user()->store()->count() > 0)
                <li class="{{ \Request::segment(1) == 'sales' ? 'active' : '' }}">
                  <a href="{{ url('sales?status=1') }}">Penjualan</a>
                </li>
              @else
                <li class="{{ \Request::segment(1) == 'store' ? 'active' : '' }}">
                  <a href="{{ url('store/create') }}">Buat Toko</a>
                </li>
              @endif
            </ul>
          </div>
          @endif
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              @if(Auth::check())
                <li>
                  <a href="{{ url('cart') }}">
                    <i class="fa fa-shopping-cart"></i>
                    @if(Auth::user()->getQuantityCart() > 0)
                    <span class="label label-warning">
                      {{ Auth::user()->getQuantityCart() }}
                    </span>
                    @endif
                  </a>
                </li>
               
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="{{ asset('img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li>
                      <a href="{{ url('profil') }}">
                        <i class="fa fa-user"></i>
                        Profil
                      </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="javascript:void(0)" onclick="return getElementById('formLogout').submit()">
                        <i class="fa fa-sign-out"></i>
                        Keluar
                      </a>
                      <form id="formLogout" method="post" action="{{ url('logout') }}">
                        {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>

              @else

                <li>
                  <a href="{{ url('login') }}">
                    <i class="fa fa-sign-in"></i>
                    Masuk
                  </a>
                </li>

              @endif

            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
      <!-- /.container-fluid -->
      </nav>
    </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              @yield('title')
              <small>@yield('page-description')</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
              @yield('breadcrumb')
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            
            @yield('content')
            
          </section>
          <!-- /.content -->
        </div>
      <!-- /.container -->
      </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="container">
        <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong> All rights
        reserved.
      </div>
    <!-- /.container -->
    </footer>
  </div>
  <!-- ./wrapper -->

  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
