@extends('auth.master')
@section('title', 'Daftar Pengguna Baru')
@section('content')
<p class="login-box-msg">Silahkan Lengkapi Data Anda</p>
<form action="{{ url('register') }}" method="post">
  {{ csrf_field() }}
   <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nama Lengkap" autocomplete="off">
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    @if($errors->has('name'))
      <span class="help-block">
        {{ $errors->first('name') }}
      </span>
    @endif
  </div>
  <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" autocomplete="off">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    @if($errors->has('email'))
      <span class="help-block">
        {{ $errors->first('email') }}
      </span>
    @endif
  </div>
  <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : ''}}">
    <input type="password" name="password" class="form-control" placeholder="Password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    @if($errors->has('password'))
      <span class="help-block">
        {{ $errors->first('password') }}
      </span>
    @endif
  </div>
  <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    @if($errors->has('password_confirmation'))
      <span class="help-block">
        {{ $errors->first('password_confirmation') }}
      </span>
    @endif
  </div>
  <div class="row">
    <!-- /.col -->
    <div class="col-xs-12">
      <button type="submit" class="btn bg-purple btn-lg btn-block">Daftar Baru</button>
    </div>
    <!-- /.col -->
  </div>
</form>
<br>
<a href="{{ url('password/reset') }}" class="text-orange">Lupa Password?</a><br>
<a href="{{ url('login') }}" class="text-orange">Masuk</a>
@endsection