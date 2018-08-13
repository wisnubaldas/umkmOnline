<div class="table-responsive">
	<table class="table table-striped table-hover" style="margin-bottom: 0">
		<tbody>
			@if($adminBanks->count() > 0)
				@foreach($adminBanks as $index => $bank)
				<tr>
					<td style="width: 10px">{{ $index + $adminBanks->firstItem() }}</td>
					<td>{{ $bank->bank_name }}</td>
					<td>{{ $bank->bank_account }}</td>
					<td>{{ $bank->under_the_name }}</td>
					<td>
						<button class="btn btn-warning btn-xs editBankBtn"
						url="{{ url('admin/admin-bank/'.$bank->id).'/edit' }}">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-xs delBankBtn"
						url="{{ url('admin/admin-bank/'.$bank->id) }}">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>
{{ $adminBanks->links() }}