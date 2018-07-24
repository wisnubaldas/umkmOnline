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
				<li class="active"><a href="javascript:void(0)">Status Pemesanan</a></li>
				<li><a href="{{ url('buy/completed') }}">Daftar Transaksi Selesai</a></li>
				<li class="pull-right header"><i class="fa fa-th"></i> Status Pemesanan</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<div class="table-responsive">
						@if($payments->count() > 0)
							@include('front.buy.table')
						@else
						<table class="table table-bordered bg-gray">
							<tbody>
								<tr><td><h3 class="text-center text-muted">Anda tidak memiliki Pemesanan yang sedang berlangsung</h3></td></tr>
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
@include('front.buy.diterima-modal')
@endsection
@include('front.buy.style')
@push('scripts')
<script>
	@include('front.buy.detail-order-script')
	//diterima
	$('body').on('click', '.diterimaBtn', function(){
		$('#diterimaModal #diterimaForm').attr('action', $(this).attr('url'));
		$('#diterimaModal').modal('show');
	});
	$('.showText').popover();
</script>
@endpush