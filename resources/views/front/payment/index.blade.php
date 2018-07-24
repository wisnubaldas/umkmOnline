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
				<li class="active"><a href="javascript:void(0)">Status Pembayaran</a></li>
				<li><a href="{{ url('buy') }}">Status Pemesanan</a></li>
				<li><a href="{{ url('buy/completed') }}">Daftar Transaksi Selesai</a></li>
				<li class="pull-right header"><i class="fa fa-th"></i> Status Pembayaran</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<div class="table-responsive">
						@if($payments->count() > 0)
						<table class="table table-bordered table-hover">
							<thead class="bg-gray">
								<tr>
									<th class="text-center">Kode</th>
									<th class="text-center">Jumlah Pembayaran</th>
									<th class="text-center">Status</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">#</th>
								</tr>
							</thead>
							<tbody>
								@foreach($payments as $payment)
									<tr>
										<td class="text-purple">{{ $payment->getCode() }}</td>
										<td class="text-right">{{ $payment->amountStringFormatted() }}</td>
										<td class="text-center">
											<span class="badge
											{{ $payment->is_paid == 1 ? 'bg-green' : 'bg-yellow' }}">
												{{ $payment->status() }}
											</span>
										</td>
										<td class="text-right">{{ $payment->tanggal() }}</td>
										<td style="max-width: 110px">
											@if(is_null($payment->payment_confirmation))
											<a href="{{ url('payment-confirmation').'?kode='.$payment->code }}" 
											class="btn bg-purple btn-xs">
												Konfirmasi Pembayaran
											</a>
											@endif
											<a href="{{ url('payment/'.$payment->code) }}" class="btn btn-default btn-xs">
												Detail
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@else
						<table class="table table-bordered bg-gray">
							<tbody>
								<tr><td><h3 class="text-center text-muted">Anda tidak memiliki pembayaran yang sedang berlangsung</h3></td></tr>
							</tbody>
						</table>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('style')
<style>
	.nav-tabs li.active { border-top-color: #605ca8 !important }
</style>
@endpush