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
				<li class="active"><a href="javascript:void(0)">Pemesanan Disetujui</a></li>
				<li><a href="{{ url('sales?status=3') }}">Pemesanan Dikirim</a></li>
				<li><a href="{{ url('sales?status=4') }}">Transaksi Selesai</a></li>
				<li class="pull-right header"><i class="fa fa-th"></i> Pemesanan Disetujui</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active">
					<div class="table-responsive">
						@if($orders->count() > 0)
							@include('front.sales.table')
						@else
						<table class="table table-bordered bg-gray">
							<tbody>
								<tr><td><h3 class="text-center text-muted">Anda tidak memiliki Pemesanan Disetujui</h3></td></tr>
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
<div class="modal" id="sendOrderModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Pengiriman Pesanan</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" id="sendOrderForm">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group">
						<label>Masukan Nomor RESI JNE</label>
						<input type="text" name="resi_number" class="form-control" required autocomplete="off">
					</div>
					<button type="submit" class="btn bg-purple btn-block">Simpan</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
@include('front.sales.style')
@push('scripts')
<script>
	@include('front.sales.detail_order_script')
	$('body').on('click', '.sendOrderBtn', function(){
		$('#sendOrderModal #sendOrderForm').attr('action', $(this).attr('url'));
		$('#sendOrderModal').modal('show');
	});
</script>
@endpush