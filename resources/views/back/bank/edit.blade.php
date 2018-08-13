<form id="editBankForm" method="post" action="{{ url('admin/admin-bank/'.$adminBank->id) }}">
	{{ csrf_field() }}
	{{ method_field('patch') }}
	<div class="form-group bank_name">
		<label>Nama Bank</label>
		<input type="text" name="bank_name" class="form-control" value="{{ $adminBank->bank_name }}" 
		required autocomplete="off">
		<span class="help-block bank_name_error"></span>
	</div>
	<div class="form-group bank_account">
		<label>Rekening Bank</label>
		<input type="text" name="bank_account" class="form-control" value="{{ $adminBank->bank_account }}" 
		required autocomplete="off">
		<span class="help-block bank_account_error"></span>
	</div>
	<div class="form-group under_the_name">
		<label>Atas Nama Bank</label>
		<input type="text" name="under_the_name" class="form-control" value="{{ $adminBank->under_the_name }}" 
		required autocomplete="off">
		<span class="help-block under_the_name_error"></span>
	</div>
	<button type="submit" class="btn bg-orange">Update</button>
</form>