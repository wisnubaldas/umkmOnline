<table class="table table-bordered table-hover">
	<thead class="bg-gray">
		<tr>
			<th class="text-center">Kode</th>
			<th class="text-center">Pembelian dari Toko</th>
			<th class="text-center">Status</th>
			<th class="text-center">RESI</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">#</th>
		</tr>
	</thead>
	<tbody>
		@foreach($payments as $payment)
			@foreach($payment->orders as $order)
				@if(!$order->isFinished())
				<tr>
					<td>{{ $order->getCode() }}</td>
					<td>{{ $order->store->name }}</td>
					<td>
						<span class="label {{ $order->isPending() ? 'label-warning' : 
						($order->isAccepted() ? 'label-info' : 
						($order->isSent() ? 'label-primary' : 'label-success')) }}">{{ $order->status->name }}</span>
						<button class="btn btn-link text-black btn-xs showText" data-toggle="popover"
						data-placement="top" data-content="{{ $order->status->textForBuyer() }}"
						data-trigger="focus">
							<i class="fa fa-question-circle"></i>
						</button>
					</td>
					<td>{{ $order->resi_number }}</td>
					<td class="text-right">{{ $order->tanggal() }}</td>
					<td>
						<button class="btn btn-default btn-xs detailOrderBtn"
						url="{{ url('buy/'.$order->id) }}">Detail</button>
						@if($order->isSent())
							<button class="btn bg-orange btn-xs diterimaBtn"
							url="{{ url('buy/'.$order->id.'/complete') }}">Sudah Diterima</button>
						@endif
					</td>
				</tr>
				@endif
			@endforeach
		@endforeach
	</tbody>
</table>