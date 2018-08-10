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
		<div class="row">
			<div class="col-sm-12">
				{{ $products->links('vendor.pagination.front') }}
			</div>
		</div>
	@else
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-body text-center">
				<br>
				<i class="fa fa-battery-empty text-orange fa-4x"></i>
				<p class="text-muted">
					<strong>Produk Tidak ditemukan</strong>
				</p>
			</div>
		</div>
	</div>
	@endif
</div>