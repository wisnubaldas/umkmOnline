@extends('front.master')
@section('title', 'Pembelian')
@section('breadcrumb')
	<li class="active">Pembelian</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li><a href="{{ url('payment') }}">Status Pembayaran</a></li>
				<li><a href="{{ url('buy') }}">Status Pemesanan</a></li>
				<li class="active"><a href="javascript:void(0)">Daftar Transaksi Selesai</a></li>
				<li class="pull-right header"><i class="fa fa-th"></i> Daftar Transaksi Selesai</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<div class="table-responsive">
						@if($orders->count() > 0)
						<table class="table table-bordered table-hover">
							<thead class="bg-gray">
								<tr>
									<th class="text-center">Kode</th>
									<th class="text-center">Pembelian dari Toko</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">#</th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($orders as $order)
									<tr>
										<td>{{ $order->getCode() }}</td>
										<td>{{ $order->store->name }}</td>
										<td class="text-right">{{ $order->tanggal() }}</td>
										<td>
											<button class="btn btn-default btn-xs detailOrderBtn"
											url="{{ url('buy/'.$order->id) }}">Detail</button>
											@if(!$order->isPending())
											<a href="{{ url('buy/'.$order->id.'/print') }}" target="_blank" class="btn btn-xs bg-navy">
												<i class="fa fa-print"></i>
												Invoice
											</a>
											@endif
										</td>
									</tr>
								@endforeach

							</tbody>
						</table>
						@else
						<table class="table table-bordered bg-gray">
							<tbody>
								<tr><td><h3 class="text-center text-muted">Anda tidak memiliki Transaksi Pembelian yang Selesai</h3></td></tr>
							</tbody>
						</table>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('front.buy.detail-order-modal')
@endsection
@include('front.buy.style')
@push('scripts')
<script>
	@include('front.buy.detail-order-script')
</script>
@endpush