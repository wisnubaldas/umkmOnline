@extends('front.master')
@section('title', 'Penjualan')
@section('breadcrumb')
	<li class="active">Penjualan</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li><a href="{{ url('sales?status=1') }}">Pemesanan Baru</a></li>
				<li><a href="{{ url('sales?status=2') }}">Pemesanan Disetujui</a></li>
				<li><a href="{{ url('sales?status=3') }}">Pemesanan Dikirim</a></li>
				<li class="active"><a href="javascript:void(0)">Transaksi Selesai</a></li>
				<li class="pull-right header"><i class="fa fa-th"></i> Transaksi Selesai</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<div class="table-responsive">
						@if($orders->count() > 0)
							@include('front.sales.table')
						@else
						<table class="table table-bordered bg-gray">
							<tbody>
								<tr><td><h3 class="text-center text-muted">Anda tidak memiliki Transaksi Selesai</h3></td></tr>
							</tbody>
						</table>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('front.sales.detail_order_modal')
@endsection
@include('front.sales.style')
@push('scripts')
<script>
	@include('front.sales.detail_order_script')
</script>
@endpush