@extends('front.master')
@section('title', 'Konfirmasi Pembayaran ' . $payment->getCode())
@section('breadcrumb')
	<li><a href="{{ url('payment') }}">Pembayaran</a></li>
	<li><a href="{{ url('payment/'.$payment->code) }}">{{ $payment->getCode() }}</a></li>
	<li class="active">Konfirmasi</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-body">
					<form method="post" action="{{ url('payment-confirmation').'?kode='.$payment->code }}"
					enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-6">

								{{ csrf_field() }}

								<div class="form-group">
									<label>Kode Pembayaran</label>
									<input type="text" name="code" class="form-control" 
									value="{{ $payment->getCode() }}" readonly>
								</div>

								<div class="form-group 
								{{ $errors->has('transfer_date') ? 'has-error' : '' }}">
									<label>Tanggal Transfer*</label>
									<input type="text" name="transfer_date" value="{{ old('transfer_date') }}" 
									class="form-control datepicker" autocomplete="off">
									@if($errors->has('transfer_date'))
										<span class="help-block">
											{{ $errors->first('transfer_date') }}
										</span>
									@endif
								</div>

								<div class="form-group
								{{ $errors->has('admin_bank_name') ? 'has-error' : ''}}">
									<label>Tujuan Bank*</label>
									<select name="admin_bank_id" class="form-control">
										<option value="">Pilih Bank</option>
										@foreach($adminBanks as $bank)
											<option value="{{ $bank->id }}"
											{{ old('admin_bank_name') == $bank->bank_name ? 'selected' : ''}}>
												{{ $bank->bank_name }} ({{ $bank->bank_account }})
											</option>
										@endforeach
									</select>
									@if($errors->has('admin_bank_name'))
										<span class="help-block">
											{{ $errors->first('admin_bank_name') }}
										</span>
									@endif
								</div>
								
								<div class="form-group
								{{ $errors->has('user_bank_name') ? 'has-error' : '' }}">
									<label>Nama Bank Pengirim*</label>
									<input type="text" name="user_bank_name" value="{{ old('user_bank_name') }}" 
									class="form-control" autocomplete="off" placeholder="Contoh: BRI">
									@if($errors->has('user_bank_name'))
										<span class="help-block">
											{{ $errors->first('user_bank_name') }}
										</span>
									@endif
								</div>

							</div>

							<div class="col-sm-6">
								
								<div class="form-group
								{{ $errors->has('bank_account') ? 'has-error' : '' }}">
									<label>Rekening Pengirim*</label>
									<input type="text" name="bank_account" value="{{ old('bank_account') }}" 
									class="form-control" autocomplete="off">
									@if($errors->has('bank_account'))
										<span class="help-block">
											{{ $errors->first('bank_account') }}
										</span>
									@endif
								</div>

								<div class="form-group
								{{ $errors->has('under_the_name') ? 'has-error' : '' }}">
									<label>Atas Nama*</label>
									<input type="text" name="under_the_name" value="{{ old('under_the_name') }}"
									class="form-control" autocomplete="off">
									@if($errors->has('under_the_name'))
										<span class="help-block">
											{{ $errors->first('under_the_name') }}
										</span>
									@endif
								</div>

								<div class="form-group
								{{ $errors->has('amount') ? 'has-error' : '' }}">
									<label>Total Transfer* (Rp)</label>
									<input type="text" name="amount" value="{{ old('amount') }}" 
									class="form-control" autocomplete="off">
									@if($errors->has('amount'))
										<span class="help-block">
											{{ $errors->first('amount') }}
										</span>
									@endif
								</div>

								<div class="form-group
								{{ $errors->has('image') ? 'has-error' : '' }}">
									<label>Upload Bukti Transfer*</label>
									<input type="file" name="image" class="form-control">
									@if($errors->has('image'))
										<span class="help-block">
											{{ $errors->first('image') }}
										</span>
									@endif
								</div>

							</div>

							<div class="col-sm-12">
								<button type="reset" class="btn btn-default btn-flat">
									Reset
								</button>
								<button type="submit" class="btn bg-orange btn-flat">
									Submit
								</button>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script>
		$('.datepicker').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	</script>
@endpush