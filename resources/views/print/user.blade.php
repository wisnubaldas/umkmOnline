@extends('print.master')
@section('title', 'Cetak Semua Pengguna')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Daftar Pengguna</h3>		
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Nama Pengguna</th>
							<th class="text-center">Email</th>
							<th class="text-center">Peran</th>
						</thead>
						<tbody>
							@if($users->count() > 0)
								@foreach($users as $index => $user)
									<tr>
										<td class="text-right">{{ $index + 1 }}</td>
										<td class="text-info"><strong>{{ $user->name }}</strong></td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->role->name }}</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4">
										@if(request('user_name'))
											Tidak ditemukan
										@else
											Belum ada Toko
										@endif
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		window.print();
	});
</script>
@endpush