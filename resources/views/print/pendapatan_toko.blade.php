@extends('print.master')
@section('title', 'Cetak Pendapatan Toko')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h5 class="box-title">Daftar Transaksi Selesai</h5>
			</div>
			<div class="box-body">
				<div class="table table-responsive">
					<table class="table table-bordered table-hover">
						<thead class="bg-gray">
							<tr>
								<th class="text-center">Tgl</th>
								<th class="text-center">Kode Pesanan</th>
								<th class="text-center">Jumlah Pembayaran</th>
								<th class="text-center">Pembeli</th>
								<th class="text-center">Status Pendapatan</th>
							</tr>
						</thead>
						<tbody>
							@if($orders->count() > 0)
								@foreach($orders as $index => $order)
									<tr>
										<td class="text-right">{{ $order->tanggal() }}</td>
										<td>{{ $order->getCode() }}</td>
										<td class="text-right">{{ $order->totalTagihanStringFormatted() }}</td>
										<td>{{ $order->user->name }}</td>
										<td class="text-center">
											<span class="label {{ $order->isPaidAdminPayment() 
											? 'label-success' : 'label-warning' }}">
												{{ $order->adminPaymentStatus() }}
											</span>
										</td>
									</tr>
								@endforeach
							@else
							<tr><td colspan="6">Tidak ada transaksi selesai</td></tr>
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