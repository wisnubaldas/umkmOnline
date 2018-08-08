@extends('front.master')
@section('title', 'Ganti Password Saya')
@section('breadcrumb')
<li class="active">Ganti Password</li>
@endsection
@section('content')
<div class="row">
	@include('front.profile.sidebar')
	<div class="col-sm-9">
		@if(session('success'))
			<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			{{ session('success') }}
			</div>
		@endif
		<div class="box box-solid">
			<div class="box-body">
				<form class="col-sm-8" method="post" action="{{ url('change-password') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
						<label>Password Lama</label>
						<input type="password" name="old_password" class="form-control"
						autocomplete="off" value="{{ old('old_password') }}">
						@if($errors->has('old_password'))
							<span class="help-block">
								{{ $errors->first('old_password') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
						<label>Password Baru</label>
						<input type="password" name="new_password" class="form-control"
						autocomplete="off" value="{{ old('new_password') }}">
						@if($errors->has('new_password'))
							<span class="help-block">
								{{ $errors->first('new_password') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
						<label>Konfirmasi Password Baru</label>
						<input type="password" name="new_password_confirmation" class="form-control"
						autocomplete="off">
						@if($errors->has('new_password_confirmation'))
							<span class="help-block">
								{{ $errors->first('new_password_confirmation') }}
							</span>
						@endif
					</div>
				
					<button type="submit" class="btn bg-orange">Ganti Password</button>
				</form>
			</div>
		</div>
	</div>		
</div>
@endsection