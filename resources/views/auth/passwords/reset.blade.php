@extends('auth.master')
@section('title', 'Atur Ulang Kata Sandi')
@section('content')
<p class="login-box-msg">Atur Ulang Kata Sandi</p>
<form action="{{ url('password/reset') }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="token" value="{{ $token }}">
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
    <input type="password" name="password" class="form-control" placeholder="Password Baru">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    @if($errors->has('password'))
      <span class="help-block">
        {{ $errors->first('password') }}
      </span>
    @endif
  </div>
  <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru">
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
      <button type="submit" class="btn bg-purple btn-lg btn-block">Atur Ulang</button>
    </div>
    <!-- /.col -->
  </div>
</form>
@endsection