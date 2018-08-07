@extends('back.master')
@section('title', 'Pembayaran Masuk')
@section('breadcrumb')
<li class="active">Pembayaran Masuk</li>
@endsection
@section('content')
@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Sukses!</h4>
		{{ session('success') }}
	</div>
@endif
<div class="callout callout-info">
	<h4><i class="icon fa fa-info"></i> Info!</h4>
	Pembayaran Masuk adalah pembayaran yang dilakukan pembeli ke administrator ( rekening bank milik admin ).
	Tugas anda sebagai admin/operator adalah memverifikasi pembayaran yang dilakukan pembeli dengan cara melihat bukti pembayaran pembeli. Pembayaran yang <strong>pending</strong> selama waktu maksimum (yang ditentukan admin), akan <strong>terhapus</strong> secara <strong>otomatis</strong>.
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<form method="get" action="{{ route('admin.payment.index') }}">
					<div class="input-group input-group">
		                <input type="text" class="form-control" name="code" value="{{ request('code') }}" 
		                placeholder="Cari Kode" required autocomplete="off">
	                    <span class="input-group-btn">
	                      <button type="submit" class="btn btn-info btn-flat">
	                      	<i class="fa fa-search"></i>
	                      </button>
	                    </span>
		             </div>
				</form>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Kode</th>
							<th class="text-center">Jumlah Pembayaran</th>
							<th class="text-center">Pembeli</th>
							<th class="text-center">Status</th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">#</th>
						</thead>
						<tbody>
							@if($payments->count() > 0)
								@foreach($payments as $index => $payment)
									<tr>
										<td class="text-right">{{ $index + $payments->firstItem() }}</td>
										<td>{{ $payment->getCode() }}</td>
										<td class="text-right">{{ $payment->amountStringFormatted() }}</td>
										<td>{{ $payment->user->name }}</td>
										<td class="text-center">
											<span class="label {{ $payment->is_paid == 0 ? 'bg-yellow' : 'bg-green' }}">
												{{ $payment->status() }}
											</span>
										</td>
										<td class="text-right">
											{{ $payment->tanggal() }}
										</td>
										<td class="text-center">
											<div class="btn-group">
												<button class="btn btn-default btn-xs paymentBtn"
												url="{{ url('admin/payment/'.$payment->id.'/detail') }}"
												modal-target="#paymentDetailModal">
													Detail
												</button>
												@if($payment->payment_confirmation()->count() > 0)
													<button class="btn bg-info btn-xs paymentBtn"
													url="{{ url('payment-confirmation/'.
													$payment->payment_confirmation()->first()->id) }}"
													modal-target="#paymentConfirmationModal">
														Bukti
													</button>
												@endif
											</div>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="7">
										@if(request('code'))
											Pembayaran tidak ditemukan
										@else
											Belum ada pembayaran
										@endif
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
				{{ $payments->links() }}
			</div>
		</div>
	</div>
</div>
{{--payment detail modal--}}
<div class="modal" id="paymentDetailModal">
	<div class="modal-dialog modal-lg"></div>
</div>
{{--payment confirmation modal--}}
<div class="modal" id="paymentConfirmationModal">
	<div class="modal-dialog modal-lg"></div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.paymentBtn', function(){
			var modal = $($(this).attr('modal-target'));
			var url = $(this).attr('url');
			$.ajax({
				method: 'get',
				url: url,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					modal.find('.modal-dialog').html(data);
					modal.modal('show');
				}
			});
		});
	});
</script>
@endpush