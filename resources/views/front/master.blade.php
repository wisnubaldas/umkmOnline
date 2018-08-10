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
<body class="hold-transition skin-purple layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="{{ url('/') }}" class="navbar-brand">{{ config('app.name') }}</a>
          </div>

          <div class="collapse navbar-collapse pull-left" id="navbar-collapse"></div>

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
               
               {{--user menu--}}
                <li class="dropdown tasks-menu user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <!-- The user image in the navbar-->
                    <img 
                    src="{{ is_null(Auth::user()->image) ? Auth::user()->nullphoto() : asset('img/user/'.Auth::user()->image) }}" 
                    class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        @if(Auth::user()->isAdmin() || Auth::user()->isOperator())
                          <li>
                            <a href="{{ url('admin/dashboard') }}" class="text-purple">
                              <i class="fa fa-dashboard"></i>
                              Admin Dashboard
                            </a>
                          </li>
                        @endif
                        <li>
                          <a href="{{ url('payment') }}" class="text-purple">
                            <i class="fa fa-cart-plus"></i>
                            Pembelian
                          </a>
                        </li>

                        <li>
                          <a href="{{ url('refund') }}" class="text-purple">
                            <i class="fa fa-undo"></i>
                            Pengembalian Dana
                          </a>
                        </li>

                        @if(Auth::user()->isHaveStore())

                        <li>
                          <a href="{{ url('sales?status=1') }}" class="text-purple">
                            <i class="fa fa-cart-arrow-down"></i>
                            Penjualan
                          </a>
                        </li>

                         <li>
                          <a href="{{ url('admin-payment') }}" class="text-purple">
                            <i class="fa fa-dollar"></i>
                            Pendapatan Toko
                          </a>
                        </li>

                        <li>
                          <a href="{{ url('store/yours') }}" class="text-purple">
                            <i class="fa fa-building"></i>
                            Toko Saya
                          </a>
                        </li>

                        <li>
                          <a href="{{ url('product/yours') }}" class="text-purple">
                            <i class="fa fa-shopping-bag"></i>
                            Produk Saya
                          </a>
                        </li>

                        @else
                        
                        <li>
                          <a href="{{ url('store/create') }}" class="text-purple">
                            <i class="fa fa-plus-circle"></i>
                            Buat Toko
                          </a>  
                        </li>
                        
                        @endif

                        <li>
                          <a href="{{ url('profile') }}" class="text-purple">
                            <i class="fa fa-user"></i>
                            Profil
                          </a>
                        </li>
                        <li>
                          <a href="javascript:void(0)" 
                          onclick="return getElementById('formLogout').submit()" class="text-purple">
                            <i class="fa fa-sign-out"></i>
                            Keluar
                          </a>
                          <form id="formLogout" method="post" action="{{ url('logout') }}">
                            {{ csrf_field() }}
                          </form>
                        </li>
                      </ul>
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

                <li>
                  <a href="{{ url('register') }}">
                    <i class="fa fa-user-plus"></i>
                    Daftar Baru
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
   @if(request()->route()->getName() == 'home')
      <div class="jumbotron bg-purple" style="margin-bottom: 0">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <h1 class="text-center">
                {{ strtoupper(config('app.name')) }}
              </h1>
              <p class="text-center text-orange">
                <strong><cite>[ Belanja irit, Berjualan profit ]</cite></strong>
              </p>
              <div class="text-center">
                <a href="{{ url('belanja') }}" class="btn bg-orange btn-lg">
                  Mulai Belanja
                </a>
              </div>
              <br>
            </div>
          </div>
        </div>
      </div>
    @endif
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">

        @if(request()->route()->getName() != 'home' && request()->route()->getName() != 'belanja')
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
        @endif

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
