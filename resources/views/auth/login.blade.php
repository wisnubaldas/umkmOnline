@extends('auth.master')
@section('title', 'Login')
@section('content')
<p class="login-box-msg">Silahkan masukkan email dan password</p>

<form action="{{ url('login') }}" method="post">
  {{ csrf_field() }}
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
  <div class="row">
    <!-- /.col -->
    <div class="col-xs-12">
      <button type="submit" class="btn bg-purple btn-lg btn-block">Masuk</button>
    </div>
    <!-- /.col -->
  </div>
</form>
<br>
<a href="{{ url('password/reset') }}" class="text-orange">Lupa Password?</a><br>
<a href="{{ url('register') }}" class="text-orange">Registrasi Pengguna Baru</a>
@endsection