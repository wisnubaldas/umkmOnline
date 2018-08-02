@extends('back.master')
@section('title', 'Daftar Toko')
@section('breadcrumb')
<li class="active">Toko</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<form method="get" action="{{ url('store') }}">
					<div class="input-group input-group">
		                <input type="text" class="form-control" name="store_name" value="{{ request('store_name') }}" 
		                placeholder="Cari nama toko" required autocomplete="off">
	                    <span class="input-group-btn">
	                      <button type="submit" class="btn btn-info btn-flat">
	                      	<i class="fa fa-search"></i>
	                      </button>
	                    </span>
		             </div>
				</form>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Nama Toko</th>
							<th class="text-center">Pemilik</th>
							<th class="text-center">Status</th>
							<th class="text-center">#</th>
						</thead>
						<tbody>
							@if($stores->count() > 0)
								@foreach($stores as $index => $store)
									<tr>
										<td class="text-right">{{ $index + $stores->firstItem() }}</td>
										<td class="text-info"><strong>{{ $store->name }}</strong></td>
										<td>{{ $store->user->name }}</td>
										<td class="text-center">
											<span class="label {{ $store->isActive() ? 'bg-green'
											: 'bg-yellow' }}">{{ $store->status() }}</span>
										</td>
										<td class="text-center">
											<a href="{{ url('store/'.$store->id) }}" class="btn btn-xs btn-default">Detail</a>
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
				{{ $stores->links() }}
			</div>
		</div>
	</div>
</div>
@endsection