@extends('print.master')
@section('title', 'Cetak Pembayaran Keluar')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Pengembalian Dana periode {{ request('dari') . ' - ' . request('sampai') }}</h3>		
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
						</thead>
						<tbody>
							@if($orders->count() > 0)
								@foreach($orders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + 1 }}</td>
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
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		window.print();
	});
</script>
@endpush