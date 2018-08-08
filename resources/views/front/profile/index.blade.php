@extends('front.master')
@section('title', 'Profile Saya')
@section('breadcrumb')
<li class="active">Profile Saya</li>
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
			{{--profil--}}
			<div id="akun" class="box-body">
				<form class="col-sm-8" method="post" action="{{ url('profile') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label>Nama</label>
						<input type="text" name="name" class="form-control" value="{{ $user->name }}"
						autocomplete="off">
						@if($errors->has('name'))
							<span class="help-block">
								{{ $errors->first('name') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="{{ $user->email }}"
						autocomplete="off">
						@if($errors->has('email'))
							<span class="help-block">
								{{ $errors->first('email') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
						<label>Alamat</label>
						<textarea name="address" class="form-control" 
						autocomplete="off">{{ $user->isHaveAddress() ? $user->address->address : '' }}</textarea>
						@if($errors->has('address'))
							<span class="help-block">
								{{ $errors->first('address') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
						<label>Kota / Kab</label>
						<select name="city_id" class="form-control">
							<option value="">Pilih Kota/Kab</option>
							@foreach($cities as $city)
							<option value="{{ $city->id }}" 
							{{ $user->isHaveStore() ? 
							( $user->address->city_id == $city->id ? 'selected' : '' ) : '' }}>
							{{ $city->name }}</option>
							@endforeach
						</select>
						@if($errors->has('city_id'))
							<span class="help-block">
								{{ $errors->first('city_id') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
						<label>Provinsi</label>
						<select name="province_id" class="form-control">
							<option value="">Pilih Provinsi</option>
							@foreach($provinces as $province)
							<option value="{{ $province->id }}" 
							{{ $user->isHaveAddress() ? 
							($user->address->province_id == $province->id ? 'selected' : '') : ''  }}>
							{{ $province->name }}</option>
							@endforeach
						</select>
						@if($errors->has('province_id'))
							<span class="help-block">
								{{ $errors->first('province_id') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
						<label>Kode Pos</label>
						<input type="text" name="postal_code" class="form-control" 
						value="{{ $user->isHaveAddress() ? $user->address->postal_code : ''}}" autocomplete="off">
						@if($errors->has('postal_code'))
							<span class="help-block">
								{{ $errors->first('postal_code') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
						<label>Telpon</label>
						<input type="text" name="phone" class="form-control" 
						value="{{ $user->isHaveStore() ? $user->address->phone : '' }}" autocomplete="off">
						@if($errors->has('phone'))
							<span class="help-block">
								{{ $errors->first('phone') }}
							</span>
						@endif
					</div>
					<button type="submit" class="btn bg-orange">Update</button>
				</form>
			</div>
		</div>
	</div>		
</div>
{{--change photo modal--}}
<div class="modal" id="gantiPhotoModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Ganti Photo</h4>
			</div>
			<div class="modal-body">
				<form id="gantiPhotoForm" method="post" action="{{ url('profile/change-photo') }}"
				enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group user_photo">
						<input type="file" name="user_photo" class="form-control" required>
						<span class="help-block user_photo_error"></span>
					</div>
					<button type="submit" class="btn btn-block btn-flat bg-orange">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('.gantiPhotoBtn').on('click', function(){
			var modal = $('#gantiPhotoModal');
			var form = modal.find('#gantiPhotoForm');
			modal.modal('show');
			form.on('submit', function(e){
				e.preventDefault();
				var url = $(this).attr('action');
				var method = 'POST';
				var formData = new FormData(this);
				$.ajax({
					method: method,
					url: url,
					data: formData,
					cache:false,
        			contentType: false,
        			processData: false,
					error: function(msg){
						var errors = msg.responseJSON.errors;
						$.each(errors, function(k, v){
							$('.'+k).addClass('has-error');
							$('.'+k+'_error').text(v);
							setTimeout(function(){
								$('.'+k).removeClass('has-error');
								$('.'+k+'_error').text('');
							}, 2000);
						});
					},
					success: function(data){
						window.location = data;
					}
				});
			});
		});
	});
</script>
@endpush
