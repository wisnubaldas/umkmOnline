@extends('back.master')
@section('title', 'Pembayaran Keluar')
@section('breadcrumb')
<li class="active">Pembayaran Keluar</li>
@endsection
@section('content')
@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Sukses!</h4>
		{{ session('success') }}
	</div>
@endif
<div class="callout callout-info">
	<h4><i class="icon fa fa-info"></i> Info!</h4>
	<strong>Pembayaran Keluar</strong> adalah Pembayaran yang dilakukan <strong>Admin/Operator</strong> kepada <strong>Toko</strong> ketika Pesanannya sudah sampai ke tangan pembeli. Tugas anda sebagai <strong>Admin/Operator</strong> adalah melakukan pembayaran kepada <strong>Toko</strong> dengan cara transfer ke <strong>Rekening Bank Toko</strong> dan mengisi <strong>Bukti Pembayaran</strong>.
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-sm-6">
						<button id="printBtn" class="btn bg-navy">
							<i class="fa fa-print"></i>
							Cetak
						</button>
					</div>
					<div class="col-sm-6">
						<form method="get" action="{{ route('admin.adminPayment.index') }}">
							<div class="input-group input-group">
				                <input type="text" class="form-control" name="code" value="{{ request('code') }}" 
				                placeholder="Cari Kode" required autocomplete="off">
			                    <span class="input-group-btn">
			                      <button type="submit" class="btn btn-info btn-flat">
			                      	<i class="fa fa-search"></i>
			                      </button>
			                    </span>
				             </div>
						</form>	
					</div>
				</div>
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
							<th class="text-center">#</th>
						</thead>
						<tbody>
							@if($orders->count() > 0)
								@foreach($orders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + $orders->firstItem() }}</td>
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
										<td class="text-center">
											@if($order->isPaidAdminPayment())
												<a href="{{ url('admin/admin-payment/'.$order->code) }}" 
												class="btn btn-default btn-xs adminPaymentbtn">
													Bukti Pembayaran Toko
												</a>
											@else
												<a href="{{ url('admin/admin-payment/create/'.$order->code) }}" 
												class="btn bg-orange btn-xs">
													Buat Bukti Pembayaran Toko
												</a>
											@endif
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
				{{ $orders->links() }}
			</div>
		</div>
	</div>
</div>
{{--bukti pembayaran modal--}}
<div class="modal fade" id="adminPaymentModal">
	<div class="modal-dialog modal-lg"></div>
</div>
{{--print modal--}}
<div class="modal fade" id="printModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Cetak Pembayaran Keluar</h4>
			</div>
			<div class="modal-body">
				<form method="get" action="{{ route('admin.adminPayment.print') }}" target="_blank">
					<div class="form-group">
						<label>Dari</label>
						<input type="text" name="dari" class="form-control datepicker" required>
					</div>
					<div class="form-group">
						<label>Sampai</label>
						<input type="text" name="sampai" class="form-control datepicker" required>
					</div>
					<button type="submit" class="btn bg-navy btn-block">
						<i class="fa fa-print"></i>
						Cetak
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.adminPaymentbtn', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			var modal = $('#adminPaymentModal');
			$.ajax({
				method: 'get',
				url: url,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					modal.find('.modal-dialog').html(data);
					modal.modal('show');
				}
			})
		});

		$('#printBtn').on('click', function(){
			var modal = $('#printModal');
			modal.find('input').val('');
			modal.modal('show');
		});

		$('.datepicker').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	});
</script>
@endpush