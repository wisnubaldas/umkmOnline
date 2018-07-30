<div class="modal-content">
	<div class="modal-header bg-purple">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span></button>
		<h4 class="modal-title">{{ $product->name }}</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-4">
				<img 
				src="{{ $product->hasImage() ? asset('img/product/'.$product->image) :
				asset('img/product/null.jpg') }}" 
				class="img-responsive img-thumbnail">
				<h4 class="text-orange text-center"><strong>{{ $product->name }}</strong></h4>
			</div>
			<div class="col-sm-8">
				<div class="well well-sm">
					<div class="row">
						<div class="col-sm-6">
							<p>
								Kategori:
								<span class="label label-default pull-right">
									{{ $product->category->name }}
								</span>
							</p>
						</div>
						<div class="col-sm-6">
							<p>
								Status:
								<span class="label label-default pull-right">
									{{ $product->status() }}
								</span>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<p>
								Berat:
								<span class="label label-default pull-right">
									{{ $product->weightInKilo() }} Kg
								</span>
							</p>
						</div>
						<div class="col-sm-6">
							<p>
								Harga:
								<span class="label label-default pull-right">
									{{ $product->priceFormatted() }}
								</span>
							</p>
						</div>
					</div>
				</div>
				<div class="well well-sm">
					<strong>Deskripsi</strong><br>
					{{ $product->description }}
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		@if($product->isInStock())
		<button url="{{ url('product/'.$product->id.'/setKosong') }}" 
		type="button" class="btn btn-default btn-flat btn-sm kosongTersediaBtn">
			Set Kosong
		</button>
		@else
		<button url="{{ url('product/'.$product->id.'/setTersedia') }}" 
		type="button" class="btn btn-default btn-flat btn-sm kosongTersediaBtn">
			Set Tersedia
		</button>
		@endif
		<a href="{{ url('product/'.$product->id.'/edit') }}" class="btn btn-warning btn-flat btn-sm">
			<i class="fa fa-edit"></i>
			Edit
		</a>
		<button type="button" class="btn btn-danger btn-flat btn-sm"
		onclick="getElementById('deleteProductBtn').submit()">
			<i class="fa fa-trash"></i>
			Hapus
		</button>
		<form id="deleteProductBtn" method="post" action="{{ url('product/'.$product->id) }}">
			{{ csrf_field() }}
			{{ method_field('delete') }}
		</form>
	</div>
</div>