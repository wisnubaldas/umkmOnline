<div class="modal-content">
	<div class="modal-header bg-purple">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Pembayaran {{ $payment->getCode() }}</h4>
	</div>
	<div class="modal-body">
		@if($payment->orders->count() > 0)
		@foreach($payment->orders as $order)
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="4" class="text-muted">
							Pembelian dari toko <strong>{{ $order->store->name }}</strong>
							({{ $order->store->address->city->name }})
							<span class="pull-right">
								<strong>{{ $order->getCode() }}</strong>
								@if($order->isRejected())
								<span class="label bg-red">{{ $order->status->name }}</span>
								@endif
							</span>
						</th>
					</tr>
				</thead>
				@if(!$order->isRejected())
				<tbody>
					@foreach($order->order_details as $item)
						<tr>
							<td class="text-muted" colspan="3">
								<h5 class="text-purple" style="margin:0">
									<strong>{{ $item->product->name }}</strong>
								</h5>
								{{ $item->quantity }} barang ({{$item->weightInKilo()}})
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
							{{ $order->user->address->address }}<br>
							{{ $order->user->address->city->type }}
							{{ $order->user->address->city->name }}
							{{ $order->user->address->province->name }}
							{{ $order->user->address->postal_code }}<br>
							Telp {{ $order->user->address->phone }}
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
				</tbody>
				@endif
				<thead>
					<tr>
						<th colspan="4" class="text-muted">
							<strong>Total Tagihan</strong>
							<span class="pull-right text-orange">
								<strong>{{ $order->totalTagihanStringFormatted() }}</strong>
							</span>
						</th>
					</tr>
				</thead>
			</table>
		</div>
		@endforeach
		@else
			<p>Tidak ada pesanan / pesanan dibatalkan</p>
		@endif
	</div>
</div>