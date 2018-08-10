@extends('auth.master')
@section('title', 'Lupa Password')
@section('content')
<p class="login-box-msg">Silahkan masukkan email</p>

<form action="{{ url('password/email') }}" method="post">
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
  <div class="row">
    <!-- /.col -->
    <div class="col-xs-12">
      <button type="submit" class="btn bg-purple btn-lg btn-block">Lupa Password</button>
    </div>
    <!-- /.col -->
  </div>
</form>
<br>
<a href="{{ url('login') }}" class="text-orange">Masuk</a><br>
<a href="{{ url('register') }}" class="text-orange">Registrasi Pengguna Baru</a>
@endsection
