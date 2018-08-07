<div class="modal-content">
	<div class="modal-header bg-purple">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Pengembalian Dana {{ $refund->order->getCode() }}</h4>
	</div>
	<div class="modal-body">
		<div class="callout callout-info">
			<h4>INFO!</h4>
			<p>
				Admin sudah melakukan Pengembalian Dana anda untuk pesanan anda yang dibatalkan penjual 
				(<strong>Toko {{ $refund->order->store->name }}</strong>).
			</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="table-responsive">
					<table class="table table-striped table-hover	">
						<tbody>
							<tr>
								<td>Tanggal Transfer</td>
								<td>{{ $refund->dateFormatted() }}</td>
							</tr>
							<tr>
								<td>Jumlah Transfer</td>
								<td>{{ $refund->amountFormatted() }}</td>
							</tr>
							<tr>
								<th colspan="2">Pengirim</th>
							</tr>
							<tr>
								<td>Nama Bank</td>
								<td>{{ $refund->admin_bank->bank_name }}</td>
							</tr>
							<tr>
								<td>Rekening Bank</td>
								<td>{{ $refund->admin_bank->bank_account }}</td>
							</tr>
							<tr>
								<td>Atas Nama</td>
								<td>{{ $refund->admin_bank->under_the_name }}</td>
							</tr>
							<tr>
								<th colspan="2">Tujuan</th>
							</tr>
							<tr>
								<td>Nama Bank</td>
								<td>{{ $refund->order->payment->payment_confirmation->user_bank_name }}</td>
							</tr>
							<tr>
								<td>Rekening Bank</td>
								<td>{{ $refund->order->payment->payment_confirmation->bank_account }}</td>
							</tr>
							<tr>
								<td>Atas Nama</td>
								<td>{{ $refund->order->payment->payment_confirmation->under_the_name }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="well">
					<strong>Bukti Transfer</strong>
					<img src="{{ asset('img/refund/'.$refund->image) }}" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	</div>
</div>