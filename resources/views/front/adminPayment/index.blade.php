@extends('front.master')
@section('title', 'Pendapatan Toko Saya')
@section('breadcrumb')
<li class="active">Pendapatan Toko</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h5 class="box-title">Daftar Transaksi Selesai</h5>
				<div class="box-tools">
					<a href="{{ route('adminPayment.print') }}" target="_blank" class="btn btn-sm bg-navy">
						<i class="fa fa-print"></i>
						Pendapatan Toko
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="table table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="bg-gray">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Kode Pesanan</th>
								<th class="text-center">Jumlah Pembayaran</th>
								<th class="text-center">Pembeli</th>
								<th class="text-center">Status Pendapatan</th>
								<th class="text-center">#</th>
							</tr>
						</thead>
						<tbody>
							@if($finishedOrders->count() > 0)
								@foreach($finishedOrders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + $finishedOrders->firstItem() }}</td>
										<td>{{ $order->getCode() }}</td>
										<td class="text-right">{{ $order->totalTagihanStringFormatted() }}</td>
										<td>{{ $order->user->name }}</td>
										<td class="text-center">
											<span class="label {{ $order->isPaidAdminPayment() 
											? 'label-success' : 'label-warning' }}">
												{{ $order->adminPaymentStatus() }}
											</span>
										</td>
										<td>
											<button class="btn btn-default btn-xs detailOrderBtn"
											url="{{ url('sales/'.$order->id) }}">
												Detail Pesanan
											</button>
											@if($order->isPaidAdminPayment())
											<button class="btn bg-purple btn-xs showAdminPaymentBtn"
											url="{{ url('admin-payment/'.$order->admin_payment->id) }}">
												Bukti Pembayaran Toko
											</button>
											@endif
										</td>
									</tr>
								@endforeach
							@else
							<tr><td colspan="6">Tidak ada transaksi selesai</td></tr>
							@endif
						</tbody>
					</table>
				</div>
				{{ $finishedOrders->links() }}
			</div>
		</div>
	</div>
</div>
@include('front.buy.detail-order-modal')
{{--modal bukti pengembalian--}}
<div class="modal" id="showAdminPaymentModal">
	<div class="modal-dialog modal-lg"></div>
</div>
@endsection
@push('scripts')
<script>
	@include('front.buy.detail-order-script')
	$('body').on('click', '.showAdminPaymentBtn', function(){
		var modal = $('#showAdminPaymentModal');
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
</script>
@endpush