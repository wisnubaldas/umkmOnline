<div class="modal-content">
	<div class="modal-header bg-purple">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Pembelian dari Toko <strong>{{ $order->store->name }}</strong></h4>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover" style="margin-bottom: 0">
			<tbody>
				@foreach($order->order_details as $item)
				<tr>
					<td class="text-muted" colspan="3">
						<h5 class="text-purple" style="margin: 0"><strong>{{ $item->product->name }}</strong></h5>
						{{ $item->quantity }} barang 
						({{ $item->weightInKilo() }})
						x {{ $item->priceStringFormatted() }}
					</td>
					<td class="text-right text-muted">
						{{ $item->totalPriceStringFormatted() }}
					</td>
				</tr>
				@endforeach
				<tr class="bg-gray">
					<td>
						<strong>Alamat Tujuan</strong><br>
						{{ $order->user->name }}<br>
						{{ $order->user->city->name }}
					</td>
					<td class="text-right">
						<strong>Total Berat Barang</strong><br>
						{{ $order->totalWeightInKilo() }}
					</td>
					<td class="text-right">
						<strong>Ongkir (JNE)</strong><br>
						({{ $order->jne_service }})
						{{ $order->ongkirStringFormatted() }}
					</td>
					<td class="text-right">
						<strong>Subtotal</strong><br>
						{{ $order->subtotalStringFormatted() }}
					</td>
				</tr>
				<tr>
					<th colspan="4" class="text-muted">
						<strong>Dibayar</strong>
						<span class="pull-right text-orange">
							<strong>{{ $order->totalTagihanStringFormatted() }}</strong>
						</span>
					</th>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
	</div>
</div>