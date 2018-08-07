@extends('back.master')
@section('title', 'Konfirmasi Pembayaran Toko')
@section('breadcrumb')
<li><a href="{{ url('admin/admin-payment') }}">Pembayaran Keluar</a></li>
<li class="active">Konfirmasi</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-body">
				<div class="callout callout-info">
					<h4>Info!</h4>
					<p>
						Sebelum mengisi form, harap dipastikan bahwa pihak admin sudah melakukan transfer kepada Toko
						<strong>{{ $order->store->name }}</strong>
					</p>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<p class="text-info">Silahkan tranfer melalui rekening dibawah</p>
						<div class="table-responsive">
							<table class="table" style="margin-bottom: 0">
								<tbody>
									<tr>
										<td>Bank</td>
										<td><strong>{{ $order->store->bank->bank_name }}</strong></td>
									</tr>
									<tr>
										<td>Nomor Rekening</td>
										<td><strong>{{ $order->store->bank->bank_account }}</strong></td>
									</tr>
									<tr>
										<td>Atas Nama</td>
										<td><strong>{{ $order->store->bank->under_the_name }}</strong></td>
									</tr>
									<tr>
										<td>Jumlah</td>
										<td class="text-orange"><strong>{{ $order->totalTagihanStringFormatted() }}</strong></td>
									</tr>
								</tbody>
							</table>
						</div>
						<p class="text-info">
							Segera setelah melakukan transfer, silahkan Admin/operator melakukan konfirmasi dengan
							mengisi form konfirmasi Pembayaran Toko.
						</p>
					</div>
					<div class="col-sm-6">
						<h4>Form Konfirmasi Pembayaran Toko</h4>
						<form method="post" action="{{ route('admin.adminPayment.store') }}"
						enctype="multipart/form-data">

							{{ csrf_field() }}
							<input type="hidden" name="order_id" value="{{ $order->id }}">

							{{-- kode order --}}
							<div class="form-group">
								<label>Kode Pesanan</label>
								<input type="text" name="code" class="form-control" 
								value="{{ $order->getCode() }}" readonly>
							</div>

							{{--Tanggal Transfer--}}
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

							{{--admin bank--}}
							<div class="form-group
							{{ $errors->has('admin_bank_id') ? 'has-error' : ''}}">
								<label>Bank Pengirim (Admin)*</label>
								<select name="admin_bank_id" class="form-control">
									<option value="">Pilih Bank</option>
									@foreach($adminBanks as $bank)
										<option value="{{ $bank->id }}"
										{{ old('admin_bank_id') == $bank->id ? 'selected' : ''}}>
											{{ $bank->bank_name }} ({{ $bank->bank_account }})
										</option>
									@endforeach
								</select>
								@if($errors->has('admin_bank_id'))
									<span class="help-block">
										{{ $errors->first('admin_bank_id') }}
									</span>
								@endif
							</div>

							{{--store bank--}}
							<div class="form-group
							{{ $errors->has('store_bank_id') ? 'has-error' : ''}}">
								<label>Bank Tujuan (Toko)*</label>
								<select name="store_bank_id" class="form-control">
									<option value="{{ $order->store->bank->id }}" selected>
										{{ $order->store->bank->bank_name }} -
										{{ $order->store->bank->bank_account }}
										({{ $order->store->bank->under_the_name }})
									</option>
								</select>
								@if($errors->has('store_bank_id'))
									<span class="help-block">
										{{ $errors->first('store_bank_id') }}
									</span>
								@endif
							</div>

							{{--Jumlah Transfer--}}
							<div class="form-group
							{{ $errors->has('amount') ? 'has-error' : '' }}">
								<label>Total Transfer* (Rp)</label>
								<input type="text" name="amount" value="{{ $order->totalTagihan() }}" 
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

							<button type="reset" class="btn btn-default btn-flat">
								Reset
							</button>
							<button type="submit" class="btn bg-orange btn-flat">
								Submit
							</button>
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
		$('.datepicker').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	</script>
@endpush