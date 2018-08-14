<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="hold-transition skin-purple fixed">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ url('admin/dashboard') }}" class="logo">
                <span class="logo-lg">{{ config('app.name') }}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        {{--notification link--}}
                        <li>
                            <a href="{{ url('admin/notification') }}">
                                <i class="fa fa-bell-o"></i>
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <span class="label label-warning">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        <li class="dropdown tasks-menu user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <img 
                                src="{{ is_null(Auth::user()->image) ? Auth::user()->nullphoto() : asset('img/user/'.Auth::user()->image) }}" 
                                class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                  <ul class="menu">
                                    <li>
                                      <a href="{{ url('/') }}" class="text-purple">
                                          <i class="fa fa-home"></i>
                                          Halaman Depan
                                      </a>
                                    </li>
                                  </ul>
                                </li>
                                <li>
                                  <ul class="menu">
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
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ is_null(Auth::user()->image) ? Auth::user()->nullphoto() : asset('img/user/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU</li>
                    {{--dashboard--}}
                    <li class="{{ request()->segment(1) == 'admin' 
                    && request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="fa fa-dashboard"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview active menu-open">
                        <a href="#">
                            <i class="fa fa-dollar"></i> <span>Pembayaran</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            {{-- Pembayaran Masuk--}}
                            <li class="{{ request()->segment(1) == 'admin' 
                            && request()->segment(2) == 'payment' ? 'active' : '' }}">
                                <a href="{{ url('admin/payment') }}">
                                    <i class="fa fa-arrow-circle-o-left"></i>
                                    <span>Pembayaran Masuk</span>
                                    @if($nPendingPayment > 0)
                                    <span class="pull-right-container">
                                      <span class="label label-warning pull-right">
                                          {{ $nPendingPayment }}
                                      </span>
                                    </span>
                                    @endif
                                </a>
                            </li>
                            {{--Pemabayaran Keluar--}}
                            <li class="{{ request()->segment(1) == 'admin' 
                            && request()->segment(2) == 'admin-payment' ? 'active' : '' }}">
                                <a href="{{ url('admin/admin-payment') }}">
                                    <i class="fa fa-arrow-circle-o-right"></i>
                                    <span>Pembayaran Keluar</span>
                                    @if($nPendingAdminPayment > 0)
                                    <span class="pull-right-container">
                                      <span class="label label-warning pull-right">
                                          {{ $nPendingAdminPayment }}
                                      </span>
                                    </span>
                                    @endif
                                </a>
                            </li>
                            {{-- Pengembalian --}}
                            <li class="{{ request()->segment(1) == 'admin'
                            && request()->segment(2) == 'refund' ? 'active' : '' }}">
                                <a href="{{ url('admin/refund') }}">
                                    <i class="fa fa-undo"></i>
                                    <span>Pengembalian Dana</span>
                                    @if($nPendingRefund > 0)
                                        <span class="pull-right-container">
                                            <span class="label label-warning pull-right">
                                                {{ $nPendingRefund }}
                                            </span>
                                        </span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--pesanan--}}
                    <li class="{{ request()->segment(1) == 'admin'
                    && request()->segment(2) == 'order' ? 'active' : '' }}">
                        <a href="{{ url('admin/order') }}">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>

                    {{--toko--}}
                    <li class="{{ request()->segment(1) == 'admin'
                    && request()->segment(2) == 'store' ? 'active' : '' }}">
                        <a href="{{ url('admin/store') }}">
                            <i class="fa fa-building"></i>
                            <span>Toko</span>
                            @if($nNotActiveStore > 0)
                            <span class="pull-right-container">
                              <span class="label label-warning pull-right">
                                  {{ $nNotActiveStore }}
                              </span>
                            </span>
                            @endif
                        </a>
                    </li>

                    {{--pengguna--}}
                    <li class="{{ request()->segment(1) == 'admin'
                    && request()->segment(2) == 'user' ? 'active' : '' }}">
                        <a href="{{ url('admin/user') }}">
                            <i class="fa fa-users"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>

                    {{--category & admin bank--}}
                    <li class="{{ request()->segment(1) == 'admin'
                    && request()->segment(2) == 'setting' ? 'active' : '' }}">
                        <a href="{{ url('admin/setting') }}">
                            <i class="fa fa-sliders"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    
                </ul>
            <!-- /.sidebar-menu -->
            </section>
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                    <small>@yield('page-description')</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @yield('breadcrumb')
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

            <!--------------------------
            | Your Page Content Here |
            -------------------------->
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} 
                <a href="{{ url('dashboard') }}">{{ config('app.name') }}</a>.
            </strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>