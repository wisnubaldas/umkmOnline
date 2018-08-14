@extends('print.master')
@section('title', 'Cetak Semua Toko')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Daftar Toko</h3>		
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Nama Toko</th>
							<th class="text-center">Pemilik</th>
							<th class="text-center">Status</th>
						</thead>
						<tbody>
							@if($stores->count() > 0)
								@foreach($stores as $index => $store)
									<tr>
										<td class="text-right">{{ $index + 1 }}</td>
										<td class="text-info"><strong>{{ $store->name }}</strong></td>
										<td>{{ $store->user->name }}</td>
										<td class="text-center">
											<span class="label {{ $store->isActive() ? 'bg-green'
											: 'bg-yellow' }}">{{ $store->status() }}</span>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4">
										@if(request('store_name'))
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