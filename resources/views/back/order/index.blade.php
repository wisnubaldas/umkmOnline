@extends('back.master')
@section('title', 'Pesanan / Order')
@section('breadcrumb')
<li class="active">Pesanan / Order</li>
@endsection
@section('content')
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
						<form method="get" action="{{ route('admin.order.index') }}">
							<div class="input-group input-group">
				                <input type="text" class="form-control" name="code" value="{{ request('code') }}" 
				                placeholder="Cari Kode Pesanan" required autocomplete="off">
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
							<th class="text-center">Kode</th>
							<th class="text-center">Pembeli</th>
							<th class="text-center">Penjual</th>
							<th class="text-center">Status</th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">#</th>
						</thead>
						<tbody>
							@if($orders->count() > 0)
								@foreach($orders as $index => $order)
									<tr>
										<td class="text-right">{{ $index + $orders->firstItem() }}</td>
										<td>{{ $order->getCode() }}</td>
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
										<td class="text-center">
											<div class="btn-group">
												<button class="btn btn-default btn-xs detailBtn"
												url="{{ url('admin/order/'.$order->id.'/detail') }}"
												modal-target="#orderDetailModal">
													Detail
												</button>
											</div>
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
				{{ $orders->links() }}
			</div>
		</div>
	</div>
</div>
{{--payment detail modal--}}
<div class="modal" id="orderDetailModal">
	<div class="modal-dialog modal-lg"></div>
</div>
{{--print modal--}}
<div class="modal fade" id="printModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Cetak Pesanan</h4>
			</div>
			<div class="modal-body">
				<form method="get" action="{{ route('admin.order.print') }}" target="_blank">
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
		$('body').on('click', '.detailBtn', function(){
			var modal = $($(this).attr('modal-target'));
			var url = $(this).attr('url');
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
			});
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
