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
				<li class="active"><a href="javascript:void(0)">Pemesanan Baru</a></li>
				<li><a href="{{ url('sales?status=2') }}">Pemesanan Disetujui</a></li>
				<li><a href="{{ url('sales?status=3') }}">Pemesanan Dikirim</a></li>
				<li><a href="{{ url('sales?status=4') }}">Transaksi Selesai</a></li>
				<li class="pull-right header"><i class="fa fa-th"></i> Pemesanan Baru</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<div class="table-responsive">
						@if($orders->count() > 0)
							@include('front.sales.table')
						@else
						<table class="table table-bordered bg-gray">
							<tbody>
								<tr><td><h3 class="text-center text-muted">Anda tidak memiliki Pemesanan Baru</h3></td></tr>
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

{{--accept modal--}}
<div class="modal" id="acceptOrderModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Menyetujui Pesanan</h4>
			</div>
			<div class="modal-body">
				<p>Apakah anda yakin menyutujui Permintaan Pesanan <strong id="orderCode"></strong>?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn bg-purple" 
				onclick="getElementById('acceptOrderForm').submit()">Ya</button>
				<form method="post" action="" id="acceptOrderForm">
					{{ csrf_field() }}
					{{ method_field('patch') }}
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@include('front.sales.style')

@push('scripts')
<script>
	@include('front.sales.detail_order_script')
	
	$('body').on('click', '.acceptOrderBtn', function(){
		$('#acceptOrderModal .modal-body #orderCode').text($(this).attr('order'));
		$('#acceptOrderModal #acceptOrderForm').attr('action', $(this).attr('url'));
		$('#acceptOrderModal').modal('show');
	});
</script>
@endpush