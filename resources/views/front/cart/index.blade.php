@extends('front.master')
@section('title', 'Keranjang')
@section('breadcrumb')
	<li class="active">Daftar Belanja</li>
@endsection
@section('content')
	@if($carts->count() > 0)
		@foreach($carts as $cart)
			@php $cart->getOngkirJson() @endphp
			<div class="row">
				<div class="col-sm-12">
					<div class="box box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">
								Pembelian dari toko:
								<strong class="text-muted">{{ $cart->store->name }}</strong>
							</h3>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" style="margin-bottom: 0">
								<tbody>
									@foreach($cart->cart_details as $item)
										<tr>
											<td class="text-muted" colspan="2">
												<h5 class="text-purple" 
												style="margin: 0"><strong>{{ $item->product->name }}</strong></h5>
										
												{{ $item->quantity }} barang 
												({{ $item->product->weightInKilo() }} kg)
												x Rp. {{ number_format($item->product->price, 0, '', '.') }}
												
												<br>
												<a href="javascript:void(0)" class="edit-quantity-btn text-orange btn-link" 
												url="{{ url('cart/'.$item->id.'/update-quantity') }}"
												product-name="{{ $item->product->name }}"
												quantity="{{ $item->quantity }}">
													<i class="fa fa-edit"></i> 
													Ubah
												</a> 
											</td>
											<td class="text-right text-muted">
												{{ $item->totalPriceStringFormatted() }}
											</td>
											<td style="max-width: 100px">
												<a href="javascript:void(0)" class="delete-detail-cart text-orange btn-link"
												url="{{ url('cart/'.$item->id.'/delete-detail-cart') }}"
												message="{{ 'Pembatalan transaksi dari toko <strong>'.$cart->store->name.'</strong> untuk produk <strong>'.$item->product->name.'</strong> Senilai <strong>'.$item->totalPriceStringFormatted().'</strong>' }}">
													<i class="fa fa-trash"></i>
													Hapus
												</a>
											</td>
										</tr>
									@endforeach
									<tr class="bg-gray">
										<td>
											<strong>Alamat Tujuan</strong><br>
											{{ $cart->user->name }}<br>
											{{ $cart->user->city->name }}
										</td>
										<td class="text-right">
											<strong>Total Berat Barang</strong><br>
											{{ $cart->totalWeightInKilo() }}
										</td>
										<td class="text-right">
											<strong>Subtotal</strong><br>
											<input type="hidden" name="subtotal">
											{{ $cart->subtotalStringFormatted() }}
										</td>
										<td style="max-width: 100px">
											<strong>Ongkos Kirim (JNE)</strong>
											@if(is_null($cart->daftarLayananJne()))
											<p class="text-red">Koneksi Bermasalah</p>
											@elseif($cart->daftarLayananJne()['status'] != 200)
											<p class="text-red">Error Code: {{ $cart->daftarLayananJne()['status'] }}</p>
											@else
											<form method="post" 
											action="{{ url('cart/'.$cart->id.'/change-jne-service') }}">
												{{ csrf_field() }}
												{{ method_field('patch') }}
												<select class="form-control" name="jne_service" onchange="this.parentElement.submit()">
													@foreach($cart->daftarLayananJne()['layanan'] as $k => $v)
														<option value="{{ $k }}" 
														{{ $k == $cart->jne_service ? 'selected' : '' }}>
															{{ $k . ' (Rp. '.number_format($v, 0, '', '.').')' }}
														</option>
													@endforeach
												</select>
											</form>
											@endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="box-footer">
							<a href="javascript:void(0)" class="text-orange btn-link delete-cart"
							url="{{ url('cart/'.$cart->id.'/destroy') }}"
							store-name="{{ $cart->store->name }}"
							subtotal="{{ $cart->subtotalStringFormatted() }}"
							message="{{ 'Pembatalan transaksi dari toko <strong>'.$cart->store->name.'</strong>  Senilai <strong>'.$cart->subtotalStringFormatted().'</strong>' }}">
								<i class="fa fa-trash"></i>
								Hapus Semua
							</a>
							<p class="pull-right">
								Total Tagihan 
								<strong class="total-tagihan">
									{{ $cart->totalTagihanStringFormatted() }}
								</strong>
							</p>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="row">
			<div class="col-sm-12">
				<h3 class="text-center">
					Keranjang Anda Kosong
				</h3>
				<a href="{{ url('/') }}" class="btn-link text-purple">
					<h3 class="text-center"><strong>Mulai Belanja</strong></h3>
				</a>	
			</div>
		</div>
	@endif

	@if($carts->count() > 0)
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-header">
					<h3 class="box-title pull-right">
						Total Pembayaran<br>
						<strong class="text-orange pull-right">
							Rp. {{ number_format($totalPembayaran, 0, '', '.') }}
						</strong>
					</h3>
				</div>
				<div class="box-body">
					<button class="btn btn-lg btn-default btn-flat"
					onclick="window.location='{{ url("/") }}'">
						<i class="fa fa-angle-left"></i>
						Lanjutkan Belanja
					</button>
					<button id="konfirmasiPembelianBtn" class="btn btn-lg bg-orange btn-flat pull-right">
						Lakukan Pembayaran
						<i class="fa fa-angle-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
	@endif
	@include('front.cart.modals')

@endsection
@push('scripts')
	<script>
		$('body').on('click', '.edit-quantity-btn', function(){
			$('#editQuantityModal #editQuantityForm').attr('action', $(this).attr('url'));
			$('#editQuantityModal input[name="product_name"]').val($(this).attr('product-name'));
			$('#editQuantityModal input[name="quantity"]').val($(this).attr('quantity'));
			$('#editQuantityModal').modal('show');
		});
		$('#editQuantityForm input[name="quantity"]').on('keyup', function(){
			if ($(this).val() < 1) {
				$('#editQuantitySubmitBtn').attr('disabled', 'disabled');
			} else {
				$('#editQuantitySubmitBtn').attr('disabled', false);
			}
		});
		$('body').on('click', '.delete-detail-cart, .delete-cart', function(){
			var modal = $('#konfirmasiPembatalanModal');
			modal.find('.modal-body').html($(this).attr('message'));
			modal.find('#pembatalanForm').attr('action', $(this).attr('url'));
			modal.modal('show');
		});

		$('#konfirmasiPembelianBtn').on('click', function(){
			$('#konfirmasiPembelianModal').modal('show');
		});
	</script>
@endpush
