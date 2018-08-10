@extends('front.master')
@section('title', 'Home')
@section('content')
@if(Auth::check())
	@if(!Auth::user()->isHaveAddress())
	<div class="callout bg-gray">
		<p>
			Sebelum berbelanja silahkan lengkapi dulu profil anda.
			<a href="{{ url('profile') }}" class="text-orange">Lengkapi Profil Saya</a> 
		</p>
		
	</div>
	@endif
@endif
<div class="row">
	@if($products->count() > 0)
		@foreach($products as $prod)
		<div class="col-sm-3 col-xs-6">
			<div class="box box-solid">
				<div class="box-body">
					<img src="{{ $prod->hasImage() ? asset('img/product/'.$prod->image) : asset('img/product/null.jpg') }}" 
					class="img-responsive">
					<h5 class="text-center text-muted">
						<strong>{{ $prod->name }}</strong>
					</h5>
					<a href="{{ url('/'.$prod->slug) }}" class="btn bg-orange btn-block">
						Detail Produk
					</a>
				</div>
			</div>
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
@endsection