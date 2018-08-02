@extends('back.master')
@section('title', 'Toko '.$store->name)
@section('breadcrumb')
<li><a href="{{ url('store') }}">Toko</a></li>
<li class="active">{{ $store->name }}</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title">Detail Toko</h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-sm-4">
						<img 
						src="{{ $store->isNullImage() ? $store->nullImage() : asset('img/store/'.$store->image) }}" 
						class="img-responsive img-thumbnail" style="margin-bottom: 10px">
					</div>
					<div class="col-sm-8">
						<div class="attachment-block">
							<h4 class="text-purple"><strong>{{ $store->name }}</strong></h4>
							<p class="text-justify">{{ $store->description }}</p>
						</div>
						<div class="table-responsive">
							<table class="table table-border">
								<tbody>
									<tr>
										<td>Pemilik</td>
										<td>{{ $store->user->name }}</td>
									</tr>
									<tr>
										<td>Status</td>
										<td>
											<span class="label {{ $store->isActive() ? 'bg-green'
											: 'bg-yellow' }}">{{ $store->status() }}</span>
										</td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>{{ $store->address->address }}</td>
									</tr>
									<tr>
										<td>Kota/Kab</td>
										<td>{{ $store->address->city->name }}</td>
									</tr>	
									<tr>
										<td>Provinsi</td>
										<td>{{ $store->address->province->name }}</td>
									</tr>
									<tr>
										<td>Kode Pos</td>
										<td>{{ $store->address->postal_code}}</td>
									</tr>
									<tr>
										<td>Telp</td>
										<td>{{ $store->address->phone }}</td>
									</tr>																	
								</tbody>
							</table>
						</div>
						<div class="pull-right">
							<button class="btn btn-sm bg-orange" data-toggle="modal" data-target="#ktpModal">KTP Pemilik</button>
							@if($store->isActive())
								<button class="btn btn-sm btn-warning activateNonActivateBtn"
								act="Nontaktifkan" url="{{ url('store/'.$store->id.'/nonactivate') }}">
								Nonaktifkan</button>
							@else
								<button class="btn btn-sm bg-purple activateNonActivateBtn"
								act="Aktifkan" url="{{ url('store/'.$store->id.'/activate') }}">
								Aktifkan</button>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('back.store.products')
	</div>
</div>
@include('back.store.modals')
@endsection
@push('scripts')
<script>
	$(function(){
		$('.activateNonActivateBtn').on('click', function(){
			var modal = $('#activateNonActivateModal');
			var act = $(this).attr('act');
			var url = $(this).attr('url');

			modal.find('#act').text(act);
			modal.find('#activateNonActivateForm').attr('action', url);
			modal.modal('show');
		})
	});
</script>
@endpush