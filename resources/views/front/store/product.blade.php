<div class="box-header with-border">
	<h3 class="box-title">Daftar Produk</h3>
</div>
<div class="box-body">
	<div class="row">
		@if($products->count() > 0)
			@foreach($products as $product)
			<div class="col-sm-3">
				<div class="box box-solid">
					<div class="box-body" style="background: #eee">
						<h4 class="text-center">{{ $product->name }}</h4>
						<p class="text-center">Rp {{ number_format($product->price, 0, '', '.') }}</p>
						<p class="text-center">
							<i class="fa fa-shopping-bag"></i>
							<span class="text-muted">{{ $product->store->name }}</span>
						</p>
						<button type="button" class="btn bg-orange btn-block btn-flat"
						onclick="{{ ! Auth::check() ? 'window.location.href = "' . 
						url('login') . '"' : 'showAddCartModal("'.url("product/".$product->id).'")'}}">
							<i class="fa fa-shopping-cart"></i>
							Beli
						</button>
					</div>
				</div>
			</div>
			@endforeach
		@else
		<div class="col-sm-12">
			<h5>Belum Ada Produk</h5>
		</div>
		@endif
	</div>
</div>