@extends('front.master')
@section('title', 'Pengembalian Dana Pesanan')
@section('breadcrumb')
<li class="active">Pengembalian Dana</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h5 class="box-title">Daftar Pesanan Yang Dibatalkan</h5>
			</div>
			<div class="box-body">
				<div class="table table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="bg-gray">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Kode Pesanan</th>
								<th class="text-center">Jumlah Pembayaran</th>
								<th class="text-center">Toko</th>
								<th class="text-center">Status Pengembalian</th>
								<th class="text-center">#</th>
							</tr>
						</thead>
						<tbody>
							@if($rejectedOrders->count() > 0)
								@foreach($rejectedOrders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + $rejectedOrders->firstItem() }}</td>
										<td>{{ $order->getCode() }}</td>
										<td class="text-right">{{ $order->totalTagihanStringFormatted() }}</td>
										<td>{{ $order->store->name }}</td>
										<td class="text-center">
											<span class="label {{ $order->isPaidRefund() 
											? 'label-success' : 'label-warning' }}">
												{{ $order->refundStatus() }}
											</span>
										</td>
										<td>
											<button class="btn btn-default btn-xs detailOrderBtn"
											url="{{ url('buy/'.$order->id) }}">
												Detail Pesanan
											</button>
											@if($order->isPaidRefund())
											<button class="btn bg-purple btn-xs showRefundBtn"
											url="{{ url('refund/'.$order->refund->id) }}">
												Bukti Pengembalian
											</button>
											@endif
										</td>
									</tr>
								@endforeach
							@else
							<tr><td colspan="5">Tidak ada Pesanan yang dibatalkan</td></tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@include('front.buy.detail-order-modal')
{{--modal bukti pengembalian--}}
<div class="modal" id="showRefundModal">
	<div class="modal-dialog modal-lg"></div>
</div>
@endsection
@push('scripts')
<script>
	@include('front.buy.detail-order-script')
	$('body').on('click', '.showRefundBtn', function(){
		var modal = $('#showRefundModal');
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