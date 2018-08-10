@extends('front.master')
@section('title', $store->name)
@section('breadcrumb')
<li class="active">{{ $store->name }}</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-4">
		<div class="box box-solid">
			<div class="box-body">
				{{--toko image--}}
				<img src="{{ $store->isNullImage() ? $store->nullImage() : asset('img/store/'.$store->image) }}"
				class="img-responsive" style="margin-bottom: 5px">
				<h4 class="text-center">
					{{ $store->name }}
				</h4>
				<h5 class="text-center text-muted">
					{{ $store->address->city->name }}
				</h5>
			</div>
		</div>
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title">
					<strong>
						<i class="fa fa-info"></i>
						Info
					</strong>
				</div>
			</div>
			<div class="box-body">
				<table class="table table-striped table-hover">
					<tbody>
						<tr>
							<td>Jumlah Produk</td>
							<td class="text-orange">{{ $store->products->count() }}</td>
						</tr>
						<tr>
							<td>Produk Terjual</td>
							<td class="text-orange">{{ $store->sales() }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title">
					<strong>
						<i class="fa fa-info"></i>
						Deskripsi Toko
					</strong>
				</div>
			</div>
			<div class="box-body">
				<p class="text-justify">
					{{ $store->description }}
				</p>
			</div>
		</div>
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title">
					<strong>
						<i class="fa fa-map-marker"></i>
						Alamat Toko
					</strong>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tbody>
								<tr>
									<td>Alamat</td>
									<td>{{ $store->address->address }}</td>
								</tr>
								<tr>
									<td>Kota</td>
									<td>{{ $store->address->city->name }}</td>
								</tr>
								<tr>
									<td>Provinsi</td>
									<td>{{ $store->address->province->name }}</td>
								</tr>
								<tr>
									<td>Kode Pos</td>
									<td>{{ $store->address->postal_code }}</td>
								</tr>
								<tr>
									<td>Telp</td>
									<td>{{ $store->address->phone }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title">
					<i class="fa fa-shopping-bag"></i>
					<strong>Produk</strong>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					@if($storeProducts->count() > 0)
						@foreach($storeProducts as $prod)
						<div class="col-sm-3 col-xs-6">
							<img src="{{ $prod->hasImage() ? asset('img/product/'.$prod->image) 
							: asset('img/product/null.jpg') }}" class="img-responsive img-thumbnail">
							<h5 class="text-center text-muted">
								<strong>{{ $prod->name }}</strong>
							</h5>
							<a href="{{ url('/'.$prod->slug) }}" class="btn bg-orange btn-block">
								Detail Produk
							</a>
						</div>
						@endforeach
					@else
					<div class="col-sm-12">
						<p class="text-center">
							<strong>Belum Ada Produk</strong>
						</p>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection