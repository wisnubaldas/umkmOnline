@extends('back.master')
@section('title', 'Pengembalian Dana Pesanan')
@section('breadcrumb')
<li class="active">Pengembalian Dana Pesanan</li>
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
	<strong>Pengembalian Dana</strong> adalah Pengembalian Dana yang dilakukan Admin kepada Pembeli ketika Pesanannya dibatalkan oleh penjual. Tugas anda sebagai Admin/Operator adalah melakukan pengembalian dana kepada pembeli dengan cara transfer ke Rekening Bank Pembeli apabila pesannya dibatalkan oleh penjual, dan mengisi form bukti transfer yang telah disediakan.
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<form method="get" action="{{ route('admin.refund.index') }}">
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
							<th class="text-center">Kode Pesanan</th>
							<th class="text-center">Jumlah Pembayaran</th>
							<th class="text-center">Nama Pembeli</th>
							<th class="text-center">Tgl Pesanan Dibatalkan</th>
							<th class="text-center">Status Pengembalian</th>
							<th class="text-center">#</th>
						</thead>
						<tbody>
							@if($rejectedOrders->count() > 0)
								@foreach($rejectedOrders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + $rejectedOrders->firstItem() }}</td>
										<td>{{ $order->getCode() }}</td>
										<td class="text-right">{{ $order->totalTagihanStringFormatted() }}</td>
										<td>{{ $order->user->name }}</td>
										<td class="text-right">
											{{ $order->tanggalUpdate() }}
										</td>
										<td class="text-center">
											<span class="label {{ $order->isPaidRefund() ? 'label-success' : 'label-warning' }}">
												{{ $order->refundStatus() }}
											</span>
										</td>
										<td class="text-center">
											@if($order->isPaidRefund())
												<a href="{{ url('admin/refund/'.$order->code) }}" 
												class="btn btn-xs btn-default refundBtn">
													Bukti Pengembalian
												</a>
											@else
												<a href="{{ url('admin/refund/create/'.$order->code) }}" class="btn btn-xs bg-orange">
													Buat Bukti Pengembalian
												</button>
											@endif
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="7">
										@if(request('code'))
											Pengembalian dana pesanan tidak ditemukan
										@else
											Pengembalian dana pesanan belum ada
										@endif
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
				{{ $rejectedOrders->links() }}
			</div>
		</div>
	</div>
</div>
{{--refund modal--}}
<div class="modal fade" id="refundModal">
	<div class="modal-dialog modal-lg"></div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.refundBtn', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			var modal = $('#refundModal');
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