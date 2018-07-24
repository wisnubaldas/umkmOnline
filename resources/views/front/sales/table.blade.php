<table class="table table-bordered table-hover">
	<thead class="bg-gray">
		<tr>
			<th class="text-center">Kode</th>
			<th class="text-center">Nama Pembeli</th>
			<th class="text-center">Status</th>
			<th class="text-center">RESI</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">#</th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $order)
			@if($order->payment->is_paid == 1)
			<tr>
				<td>{{ $order->getCode() }}</td>
				<td>{{ $order->user->name }}</td>
				<td>
					<span class="label {{ $order->isPending() ? 'label-warning' : 
					($order->isAccepted() ? 'label-info' : 
					($order->isSent() ? 'label-primary' : 'label-success')) }}">{{ $order->status->name }}</span>
					<button class="btn btn-link text-black btn-xs showText" data-toggle="popover"
					data-placement="top" data-content="{{ $order->status->textForSeller() }}"
					data-trigger="focus">
						<i class="fa fa-question-circle"></i>
					</button>
				</td>
				<td>
					@if(!is_null($order->resi_number))
						<div class="input-group input-group-sm">
							<input type="text" name="resi_number" value="{{ $order->resi_number }}" class="form-control input-sm" readonly>
							@if($order->isSent())
							<span class="input-group-btn">
								<button class="btn btn-xs bg-orange editResiBtn"
								url="{{ url('sales/'.$order->id.'/update-resi') }}"
								resi="{{ $order->resi_number }}">
									<i class="fa fa-edit"></i>
								</button>
							</span>
							@endif
						</div>
					@endif
				</td>
				<td class="text-right">{{ $order->tanggal() }}</td>
				<td>
					<button class="btn btn-default btn-xs detailOrderBtn"
					url="{{ url('sales/'.$order->id) }}">Detail</button>
					@if($order->isPending())
					<button class="btn bg-orange btn-xs acceptOrderBtn"
					order="{{ $order->getCode() }}" url="{{ url('sales/'.$order->id.'/accept') }}">
						Setujui dan Proses
					</button>
					@elseif($order->isAccepted())
					<button class="btn bg-orange btn-xs sendOrderBtn"
					url="{{ url('sales/'.$order->id.'/send') }}">
						Kirim
					</button>
					@endif
				</td>
			</tr>
			@else
			<tr>
				<td colspan="5">
					<h3 class="text-center text-muted">Anda tidak memiliki Pemesanan Baru</h3>
				</td>
			</tr>
			@Endif
		@endforeach
	</tbody>
</table>