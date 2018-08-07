@extends('front.master')
@section('title', 'Membuat Toko')
@section('breadcrumb')
	<li class="active">Membuat Toko</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Buka Toko</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-8">
							<form class="form-horizontal" method="post" action="{{ url('store') }}"
							enctype="multipart/form-data">
								{{ csrf_field() }}
								{{--store name--}}
								<div class="form-group {{ $errors->has('store_name') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Nama Toko</label>
									<div class="col-sm-10">
										<input type="text" name="store_name" class="form-control" value="{{ old('store_name') }}">
										@if($errors->has('store_name'))
											<span class="help-block">
												{{ $errors->first('store_name') }}
											</span>
										@endif
									</div>
								</div>
								{{--store desc--}}
								<div class="form-group {{ $errors->has('store_description') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Deskripsi Toko</label>
									<div class="col-sm-10">
										<textarea name="store_description" class="form-control" rows="8">{{ old('store_description') }}</textarea>
										@if($errors->has('store_description'))
											<span class="help-block">
												{{ $errors->first('store_description') }}
											</span>
										@endif
									</div>
								</div>
								{{--province--}}
								<div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Provinsi</label>
									<div class="col-sm-10">
										<select id="province" class="form-control" name="province_id"
										url="{{ url('additional/province') }}">
											<option value="">Isi Provinsi</option>
										</select>
										@if($errors->has('province_id'))
											<span class="help-block">
												{{ $errors->first('province_id') }}
											</span>
										@endif
									</div>
								</div>
								{{--city--}}
								<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Kota/Kabupaten</label>
									<div class="col-sm-10">
										<select id="city" class="form-control" name="city_id"
										url="{{ url('additional/city/') }}" province_id=>
											<option value="">Isi Kota/Kab</option>
										</select>
										@if($errors->has('city_id'))
											<span class="help-block">
												{{ $errors->first('city_id') }}
											</span>
										@endif
									</div>
								</div>
								{{--alamat toko--}}
								<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Alamat Toko</label>
									<div class="col-sm-10">
										<textarea name="address" 
										class="form-control" rows="5">{{ Auth::user()->address->address }}</textarea>
										@if($errors->has('address'))
											<span class="help-block">
												{{ $errors->first('address') }}
											</span>
										@endif
									</div>
								</div>
								{{--postal code--}}
								<div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Kode Pos</label>
									<div class="col-sm-10">
										<input type="text" name="postal_code" class="form-control" 
										value="{{ Auth::user()->address->postal_code }}">
										@if($errors->has('postal_code'))
											<span class="help-block">
												{{ $errors->first('postal_code') }}
											</span>
										@endif
									</div>
								</div>
								{{--phone--}}
								<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Nomor Telp</label>
									<div class="col-sm-10">
										<input type="text" name="phone" class="form-control" 
										value="{{ Auth::user()->address->phone }}">
										@if($errors->has('phone'))
											<span class="help-block">
												{{ $errors->first('phone') }}
											</span>
										@endif
									</div>
								</div>
								{{--bank name--}}
								<div class="form-group {{ $errors->has('bank_name') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Nama Bank</label>
									<div class="col-sm-10">
										<input type="text" name="bank_name" class="form-control" 
										autocomplete="off">
										@if($errors->has('bank_name'))
											<span class="help-block">
												{{ $errors->first('bank_name') }}
											</span>
										@endif
									</div>
								</div>
								{{--bank Account--}}
								<div class="form-group {{ $errors->has('bank_account') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Rekening Bank</label>
									<div class="col-sm-10">
										<input type="text" name="bank_account" class="form-control" 
										autocomplete="off">
										@if($errors->has('bank_account'))
											<span class="help-block">
												{{ $errors->first('bank_account') }}
											</span>
										@endif
									</div>
								</div>
								{{--bank Account--}}
								<div class="form-group {{ $errors->has('under_the_name') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Atas Nama</label>
									<div class="col-sm-10">
										<input type="text" name="under_the_name" class="form-control" 
										autocomplete="off">
										@if($errors->has('under_the_name'))
											<span class="help-block">
												{{ $errors->first('under_the_name') }}
											</span>
										@endif
									</div>
								</div>
								{{--ktp--}}
								<div class="form-group {{ $errors->has('ktp') ? 'has-error' : '' }}">
									<label class="col-sm-2 control-label">Upload KTP</label>
									<div class="col-sm-10">
										<input type="file" name="ktp" class="form-control" value="{{ old('ktp') }}">
										@if($errors->has('ktp'))
											<span class="help-block">
												{{ $errors->first('ktp') }}
											</span>
										@endif
									</div>
								</div>
								{{--button--}}
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<button type="submit" class="btn bg-orange">Buat Toko</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script>
	$(function(){
		//province
		var province = $('#province');
		var url = province.attr('url');
		$.ajax({
			method: 'get',
			url: url,
			error: function(msg){
				console.log(msg.responseJSON);
			},
			success: function(data){
				$('#province').append(data);
				//city
				var url = $('#city').attr('url') + '/' + province.val();
				$.ajax({
					method: 'get',
					url: url,
					error: function(msg){
						console.log(msg.responseJSON);
					},
					success: function(data){
						$('#city').html(data);
					}
				})
			}
		});

		$('body').on('change', '#province' ,function(){
			var citySelect = $('#city');
			if ($(this).val() == "") {
				citySelect.attr('disabled', 'disabled');
			} else {
				citySelect.attr('disabled', false);
				var url = citySelect.attr('url') + '/' + $(this).val();
				$.ajax({
					method: 'get',
					url: url,
					error: function(msg){
						console.log(msg.responseJSON);
					},
					success: function(data){
						$('#city').html(data);
					}
				})
			}
		});
	});
</script>
@endpush