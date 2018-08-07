{{--Edit Bank Modal--}}
<div class="modal" id="editBankModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Alamat Toko</h4>
			</div>
			<div class="modal-body">
				<form class="editStoreForm" method="post" action="{{ url('store/'.$store->id.'?attr=bank') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group bank_name">
						<label>Nama Bank</label>
						<input type="text" name="bank_name" class="form-control" value="{{ $store->bank->bank_name }}">
						<span class="help-block bank_name_error"></span>
					</div>
					<div class="form-group bank_account">
						<label>Rekening Bank</label>
						<input type="text" name="bank_account" class="form-control" value="{{ $store->bank->bank_account }}">
						<span class="help-block bank_account_error"></span>
					</div>
					<div class="form-group under_the_name">
						<label>Atas Nama</label>
						<input type="text" name="under_the_name" class="form-control" value="{{ $store->bank->under_the_name }}">
						<span class="help-block under_the_name_error"></span>
					</div>
					<button type="submit" class="btn btn-block btn-flat bg-orange">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>