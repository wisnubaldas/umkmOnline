@extends('print.master')
@section('title', 'Cetak Pesanan')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Pesanan periode {{ request('dari') . ' - ' . request('sampai') }}</h3>		
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Kode</th>
							<th class="text-center">Nilai</th>
							<th class="text-center">Pembeli</th>
							<th class="text-center">Penjual</th>
							<th class="text-center">Status</th>
							<th class="text-center">Tanggal</th>
						</thead>
						<tbody>
							@if($orders->count() > 0)
								@foreach($orders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + 1 }}</td>
										<td>{{ $order->getCode() }}</td>
										<td class="text-right">{{ $order->totalTagihanStringFormatted() }}</td>
										<td>{{ $order->user->name }}</td>
										<td>{{ $order->store->name }}</td>
										<td class="text-center">
											<span class="label {{ $order->isPending() ? 'bg-yellow' : (
											$order->isAccepted() ? 'bg-info' : (
											$order->isSent() ? 'bg-blue' : (
											$order->isFinished() ? 'bg-green' : 'bg-red'))) }}">
												{{ $order->status->name }}
											</span>
										</td>
										<td class="text-right">
											{{ $order->tanggal() }}
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="7">
										@if(request('code'))
											Pesanan tidak ditemukan
										@else
											Belum ada Pesanan
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