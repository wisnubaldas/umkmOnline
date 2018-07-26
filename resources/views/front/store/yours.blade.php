@extends('front.master')
@section('title', 'Toko Saya')
@section('breadcrumb')
<li class="active">Toko Saya</li>
@endsection
@section('content')

@if(session('success'))
	<div class="callout callout-success">
		<h4>Sukses!</h4>
		<p>{{ session('success') }}</p>
	</div>
@endif

@if(!$store->isActive())
	<div class="callout callout-warning">
		<h4>Pending!</h4>
		<p>Toko anda Belum aktif, Admin sedang verifikasi data toko anda</p>
	</div>
@endif

<div class="row">
	<div class="col-sm-3">
		<div class="box box-solid">
			<div class="box-body" style="padding-top: 20px">
				<img class="profile-user-img img-responsive" 
				src="{{ is_null($store->image) ? $store->nullimage() : '' }}" alt="{{ $store->name }}">
				<h3 class="profile-username text-center">{{ $store->name }}</h3>
				<p class="text-muted text-center">{{ $store->address->city->name }}</p>
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Penjualan</b> <a class="pull-right text-orange">{{ $store->sales() }}</a>
					</li>
					<li class="list-group-item">
						<b>Jumlah Produk</b> <a class="pull-right text-orange">{{ $store->products()->count() }}</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="box box-solid">
			<div class="box-body">
				<ul class="nav nav-pills nav-stacked">
					<li class="{{ request('view') == 'product' ? '' : 'active' }}">
						<a href="{{ url('store/yours') }}" class="text-purple">Info Toko</a>
					</li>
					<li class="{{ request('view') == 'product' ? 'active' : ''  }}">
						<a href="{{ url('store/yours?view=product') }}" class="text-purple">Produk</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="box box-solid">
			@if(request('view') == 'product')
				@include('front.store.product')
			@else
				@include('front.store.info')
			@endif
		</div>
	</div>
</div>

@endsection
@push('style')
<style>
	.nav-tabs li.active { border-top-color: #605ca8 !important }
	.nav-pills li.active a { border-left: 0 !important; background-color: #eee }
</style>
@endpush