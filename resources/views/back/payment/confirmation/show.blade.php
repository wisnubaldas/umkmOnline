<div class="modal-content">
	<div class="modal-header bg-purple">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span></button>
		<h4 class="modal-title">Konfirmasi Pembayaran {{ $paymentConfirmation->payment->getCode() }}</h4>
	</div>
	<div class="modal-body">
		@if($paymentConfirmation->payment->is_paid == 0)
		<div class="callout callout-info">
			<h4>Info Pembayaran</h4>
			<p>
				Seorang pembeli telah melakukan pembayaran/transfer ke rekening
				<strong>
					{{ $paymentConfirmation->admin_bank->bank_name }}
					({{ $paymentConfirmation->admin_bank->bank_account }})
				</strong>
				atas nama <strong>{{ $paymentConfirmation->admin_bank->under_the_name }}</strong> 
			</p>
		</div>
		@endif
		<div class="row">
			<div class="col-sm-8">
				<div class="form-group">
					<label>Tanggal Transfer</label>
					<input type="text" name="transfer_date" class="form-control" 
					value="{{ $paymentConfirmation->dateFormatted() }}" readonly>
				</div>
				<div class="form-group">
					<label>Nama Bank Pembeli</label>
					<input type="text" name="bank_name" class="form-control"
					value="{{ $paymentConfirmation->user_bank_name }}" readonly>
				</div>
				<div class="form-group">
					<label>Rekening Bank Pembeli</label>
					<input type="text" name="bank_account" class="form-control"
					value="{{ $paymentConfirmation->bank_account }}" readonly>
				</div>
				<div class="form-group">
					<label>Atas Nama</label>
					<input type="text" name="under_the_name" class="form-control"
					value="{{ $paymentConfirmation->under_the_name }}" readonly>
				</div>
				<div class="form-group">
					<label>Jumlah Transfer</label>
					<input type="text" name="amount" class="form-control"
					value="{{ $paymentConfirmation->amountStringFormatted() }}" readonly>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Bukti Pembayaran</label>
					<img src="{{ asset('img/payment_confirmation/'.$paymentConfirmation->image) }}"
					class="img-responsive">
				</div>
			</div>
		</div>
		@if($paymentConfirmation->payment->is_paid == 0)
		<div class="callout bg-gray">
			<p>
				Jika anda yakin pembeli telah melakukan pembayaran sebagai mana konfirmasi pembayaran pembeli diatas, silakan tekan tombol "Pembayaran Selesai", dengan itu, maka pembayaran ini selesai dan pesanan yang terkait didalamnya akan diteruskan ke penjual.
			</p>
		</div>
		@endif
	</div>
	@if($paymentConfirmation->payment->is_paid == 0)
	<div class="modal-footer">
		<form method="post" action="{{ url('payment/'.$paymentConfirmation->payment->id.'/done') }}">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<button type="submit" class="btn bg-orange btn-flat">
				Pembayaran Selesai
			</button>
		</form>
	</div>
	@endif
</div>