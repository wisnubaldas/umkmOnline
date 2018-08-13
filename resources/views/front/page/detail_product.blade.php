@extends('front.master')
@section('title', $product->name)
@section('breadcrumb')
<li class="active">
	{{ $product->name }}
</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-4">
		<div class="box box-solid">
			<div class="box-body">
				{{--product image--}}
				<img src="{{ $product->hasImage() ? asset('img/product/'.$product->image) : asset('img/product/null.jpg') }}"
				class="img-responsive" style="margin-bottom: 5px">
				@if(Auth::id() != $store->user->id)
				{{--chat btn--}}
				<button class="btn btn-default btn-lg btn-block"
				onclick="{{ ! Auth::check() ? 'window.location.href = "' . 
				url('login') . '"' : 'showTanyaPenjualModal()' }}">
					<i class="fa fa-comments"></i>
					Tanya Penjual
				</button>
				{{--tambah ke keranjang--}}
				<button class="btn bg-orange btn-lg btn-block"
				onclick="{{ ! Auth::check() ? 'window.location.href = "' . 
				url('login') . '"' : 'showAddCartModal("'.url("product/".$product->id).'")'}}"
				{{ $product->isInStock() && $store->isActive() ? '' : 'disabled'}}>
					<i class="fa fa-cart-plus"></i>
					Tambah ke keranjang
				</button>
				@endif
			</div>
		</div>

		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title">
					<strong>Toko</strong>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-4">
						<img src="{{ is_null($store->image) ? $store->nullimage() : asset('img/store/'.$store->image) }}" 
						class="img-responsive img-thumbnail">
					</div>
					<div class="col-xs-8">
						<h4 class="text-orange text-center">{{ $store->name }}</h4>
						<a href="{{ url('toko/'.$store->slug) }}" class="btn btn-default btn-block btn-sm">
							Kunjungi Toko
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		@if(!$store->isActive())
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-warning"></i> Alert!</h4>
				Toko ini dalam status tidak aktif, anda tidak dapat membeli barang di toko ini.
			</div>
		@endif
		<div class="box box-solid">
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" style="margin-bottom: 0">
						<tbody>
							<tr>
								<td>Berat</td>
								<td><span class="text-orange">{{ $product->weightInKilo() . ' Kg' }}</span></td>
							</tr>
							<tr>
								<td>Harga</td>
								<td><span class="text-orange">{{ $product->priceFormatted() }}</span></td>
							</tr>
							<tr>
								<td>Stok</td>
								<td>
									<span class="label {{ $product->isInStock() ? 'label-success' : 'label-danger' }}">
										{{ $product->status() }}		
									</span>
								</td>
							</tr>
							<tr>
								<td>Terjual</td>
								<td><span class="text-orange">{{ $product->order_details()->count() }}</span></td>
							</tr>
							<tr><td></td><td></td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{--deskripsi product--}}
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title"><strong>Deskripsi Product</strong></div>
			</div>
			<div class="box-body">
				<p class="text-justify">
					{{ $product->description }}
				</p>
			</div>
		</div>
		{{-- daftar product ditoko yg sama --}}
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title">
					<strong>Produk Lainnya</strong>
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

{{--AddCartModal--}}
<div class="modal fade" id="addCartModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Beli</h4>
			</div>
			<form id="addToCartForm" method="post" action="{{ url('cart') }}">
				<div class="modal-body">
					{{ csrf_field() }}
					<input type="hidden" id="productId" name="productId" value="">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td>Nama Barang</td>
								<td id="productName"></td>
							</tr>
							<tr>
								<td>Harga Satuan</td>
								<td>Rp <span id="productPrice"></span></td>
							</tr>
							<tr>
								<td>Jumlah Barang</td>
								<td>
									<input type="number" id="quantity" 
									name="quantity" class="form-control" value="1"
									onchange="updateSubtotal()">
								</td>
							</tr>
							<tr>
								<td>Subtotal</td>
								<td>Rp <span id="subtotal"></span></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button id="buyBtn" type="submit" class="btn bg-orange btn-block btn-flat">
						<i class="fa fa-shopping-cart"></i>
						Beli Produk Ini
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- modal add Cart Sukses --}}
<div class="modal fade" id="AddCartModalSuccess">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<h4 class="modal-title">
					Success
				</h4>
			</div>
			<div class="modal-body">
				<div class="callout callout-success" style="margin-bottom: 0">
					<p>Produk Berhasil Dimasukkan ke Keranjang Belanja</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left btn-flat"
				onclick="window.location='{{ url('/belanja') }}'">
					<i class="fa fa-angle-double-left"></i>
					Lanjutkan Berbelanja
				</button>
				<button type="button" class="btn bg-orange btn-flat" 
				onclick="window.location='{{ url('cart') }}'">
					Bayar
					<i class="fa fa-angle-double-right"></i>
				</button>
			</div>
		</div>
	</div>
</div>

{{-- tanya penjual modal --}}
<div class="modal" id="tanyaPenjualModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Tanya Penjual</h4>
			</div>
			<div class="modal-body">
				<form id="tanyaPenjualForm" method="post" action="{{ url('product-conversation') }}">
					{{ csrf_field() }}
					<input type="hidden" name="product_id" value="{{ $product->id }}">
					<div class="form-group">
						<label>Pesan</label>
						<textarea name="message" class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn bg-orange">
							<i class="fa fa-paper-plane"></i>
							Kirim
						</button>
						<span class="label label-success pull-right" id="sentMessage"></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('#addToCartForm').on('submit', function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			var method = 'post';
			var data = $(this).serialize();
			$.ajax({
				method: method,
				url: url,
				data: data,
				beforeSend: function(){
					$('#addCartModal #buyBtn').text('Memuat..').attr('disabled', 'disabled');
				},
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					setTimeout(function(){
						console.log(data)
						$('#addCartModal').modal('hide');
						$('#AddCartModalSuccess').modal({
							backdrop: 'static',
							keyboard: false
						});
						$('#addCartModal #buyBtn').text('Beli Produk Ini').attr('disabled', false);
					}, 1000);
				}
			});
		});

		//form kirim pesan
		$('body').on('submit', '#tanyaPenjualForm', function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			var data = $(this).serialize();
			$.ajax({
				method: 'post',
				url: url,
				data: data,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					var modal = $('#tanyaPenjualModal');
					modal.find('#tanyaPenjualForm').find('textarea').val('');
					$('#sentMessage').text(data);
				}
			});
		});
	});

	function showAddCartModal(url) {
		$.ajax({
			method: 'get',
			url: url,
			error: function(msg){
				console.log(msg.responseJSON);
			},
			success: function(data){
				$('#addCartModal #productId').val(data.id);
				$('#addCartModal #productName').text(data.name);
				$('#addCartModal #productPrice').text(data.price);
				$('#addCartModal #quantity').val(1);
				$('#addCartModal #subtotal').text(data.price * $('#quantity').val());
				$('#addCartModal').modal('show');
			} 
		});
	}

	function updateSubtotal() {
		var price = $('#productPrice').text();
		var quantity = $('#quantity').val();
		if (quantity == 0) { $('#addCartModal #buyBtn').attr('disabled', 'disabled') }
		else { $('#addCartModal #buyBtn').attr('disabled', false) }
		$('#subtotal').text(price * quantity); 
	}

	function showTanyaPenjualModal()
	{
		var modal = $('#tanyaPenjualModal');
		var form = modal.find('#tanyaPenjualForm');
		$('#sentMessage').text('');
		form.find('textarea[name="message"]').val('');
		modal.modal('show');
	}
</script>
@endpush