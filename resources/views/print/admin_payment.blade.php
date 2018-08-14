@extends('print.master')
@section('title', 'Cetak Pembayaran Keluar')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Pembayaran Keluar periode {{ request('dari') . ' - ' . request('sampai') }}</h3>		
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Kode Pesanan</th>
							<th class="text-center">Jumlah Pembayaran</th>
							<th class="text-center">Toko</th>
							<th class="text-center">Tanggal Pesanan Sampai</th>
							<th class="text-center">Status</th>
						</thead>
						<tbody>
							@if($orders->count() > 0)
								@foreach($orders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + 1 }}</td>
										<td>{{ $order->getCode() }}</td>
										<td class="text-right">{{ $order->totalTagihanStringFormatted() }}</td>
										<td>{{ $order->store->name }}</td>
										<td class="text-right">
											{{ $order->tanggalUpdate() }}
										</td>
										<td class="text-center">
											<span class="label 
											{{ $order->isPaidAdminPayment() ? 'label-success' : 'label-warning' }}">
												{{ $order->adminPaymentStatus() }}
											</span>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="7">
										@if(request('code'))
											Pembayaran keluar tidak ditemukan
										@else
											Belum ada pembayaran keluar
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