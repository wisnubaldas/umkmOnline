<div class="box box-solid">
	<div class="box-header with-border">
		<h4 class="box-title">Daftar Produk</h4>
	</div>
	<div class="box-body">
		@if($store->products->count() > 0)
			<div class="row">
				@foreach($store->products as $product)
				<div class="col-sm-2">
					<a href="{{ url($product->slug) }}">
						<div class="attachment-block">
							<img src="{{ $product->hasImage() ? asset('img/product/'.$product->image) :
							asset('img/product/null.jpg') }}" 
							class="img-responsive">
							<h5 class="text-purple text-center">{{ $product->name }}</h5>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		@else
		<p>Belum ada Produk</p>
		@endif
	</div>
</div>