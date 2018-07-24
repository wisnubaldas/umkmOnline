@extends('front.master')
@section('title', 'Beranda')
@section('page-description', 'Daftar Produk')
@section('content')
	<div class="row">
		@if($products->count() > 0)
			@foreach($products as $product)
				<div class="col-sm-3">
					<div class="box box-solid">
						<div class="box-body">
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
				<p>Belum Ada Produk</p>
			</div>
		@endif
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
					onclick="window.location='{{ url('/') }}'">
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
						}, 2000);
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
	</script>
@endpush
